<?php
namespace app\index\controller;
use app\common\controller\Base;
use app\common\model\Article;
use app\common\model\ArtCate;
use app\common\model\Comment;
use think\Db;
use think\facade\Request;
class Index extends Base
{
    //首页
    public function index()
    {
        //全局查询条件
        $map = []; //将所有的查询条件封装到这个数组
        //条件1：
        $map[] = ['status','=',1];
        //实现搜索功能
        $keywords = Request::param('keywords');
        if(!empty($keywords)){
            $map[] = ['title','like','%'.$keywords.'%'];
        }

        //分类信息显示|| 列表信息的分页显示
        $cateId = Request::param('cate_id');
        //如果存在分类id
        if(isset($cateId)){
            //条件三
            $map[] = ['cate_id','=',$cateId];
            $res = ArtCate::get($cateId);
            $artList = Db::table('article')
                ->where($map)
                ->order('create_time','desc')
                ->paginate(4);
            $this->view->assign('cateName',$res->name);
        }else{
            $this->view->assign('cateName','全部文章');
            $artList = Db::table('article')
                ->where($map)
                ->order('create_time','desc')
                ->paginate(4);
        }
        $this->view->assign('empty','<h3>没有文章</h3>');
        $this->view->assign('artList',$artList);
        return $this->fetch();

//    分类信息显示 ||列表信息的分页显示
/*       $cateId = Request::param('cate_id');
        //如果存在分类id
        if(isset($cateId)){
            $res = Cate::get($cateId);
            $this->view->assign('cateName',$res->name);
        }else{
            $this->view->assign('cateName','全部文章');
        }

//        列表信息的分页显示
        $artList = Article::all(function($query) use ($cateId){
            if(isset($cateId)){
                $query->where('status',1)
                    ->where('cate_id',$cateId)
                    ->order('create_time','desc')
            }else{
                $query->where('status',1)
                    ->order('create_time','desc')->paginate(2);
            }
        });
        //另一种方法
        if(isset($cateId)){
            $artList = Db::table('article')->where('status',1)
                ->where('cate_id',$cateId)
                ->order('create_time','desc')
                ->paginate(2);
        }else{
            $artList = Db::table('article')->where('status',1)
                ->order('create_time','desc')
                ->paginate(2);
        }
        $this->view->assign('artList',$artList);

        return $this->fetch();
    }*/

    }

    //添加文章界面
    public function insert(){
        //登录才允许发布文章
        $this->isLogin();
        //设置页面标题
        $this->view->assign('title','发布文章');
        //获取一下栏目的信息
        $cateList = ArtCate::all();
        if(count($cateList) >0){
            //将查询的栏目信息赋值给模板
            $this->assign('cateList',$cateList);
        }else{
            $this->error('请先添加栏目','index/index');
        }
        //发布界面渲染
        return $this->view->fetch('insert');
    }

    //发布文章
    public function save(){
       if(Request::post()){
           //获取一下用户提交的信息
           $data = Request::post();
           $res = $this->validate($data,'app\common\validate\Article');
           if(true !== $res){
               echo '<script>alert("'.$res.'");window.location.href="insert.html";</script>';
//                echo '<script>alert("'.$res.'");location.back();</script>';
           }else{
               //验证成功
               $file = Request::file('title_img');
               //文件信息验证
               $info = $file->validate([
                   'size'=>5000000,
                   'ext'=>'jpg,jpeg,png,gif',
               ])->move('uploads');
               if($info){
                  $data['title_img'] =  $info->getSaveName();
               }else{
                   $this->error($file->getError());
               }
               //将数据存储在数据库中
               if(Article::create($data)){
                   $this->success('文章发布成功','index/index');
               }else{
                   $this->error('文章保存失败');
               }
           }
       }else{
         $this->success('请求类型错误');
        }
    }

    //详情页
    public function detail(){
        $artId = Request::param('id');
        $art = Article::get(function($query) use ($artId){
            $query->where('id','=',$artId)
                ->setInc('pv');
        });
        if(!is_null($art)){
            $this->view->assign('art',$art);
        }
        //添加评论
        $this->view->assign('commentList',Comment::all(function ($query) use ($artId){
            $query->where('status',1)//允许显示
                ->where('article_id',$artId)//当前文档ID
                ->order('create_time','desc');//最新的评论
        }));
        $this->view->assign('title','详情页');
        return $this->view->fetch('detail');
    }

    //收藏
    public function fav(){
        if(!Request::isAjax()){
            return ['status'=>-1,'message'=>'请求类型错误'];
        }
        //获取从前端传递过来的数据
        $data = Request::param();
        //判断用户是否为空
        if(empty($data['session_id'])){
            return ['status'=>-2,'message'=>'请登录后在收藏'];
        }else{
            //查询条件
            $map[] = ['user_id','=',$data['user_id']];
            $map[] = ['art_id','=',$data['art_id']];
            $fav = Db::table('user_fav')->where($map)->find();
            if(is_null($fav)){
                Db::table('user_fav')->data([
                    'user_id'=>$data['user_id'],
                    'art_id'=>$data['art_id'],
                ])->insert();
                return ['status'=>1,'message'=>'收藏成功'];
            }else{
                Db::table('user_fav')->where($map)->delete();
                return ['status'=>0,'message'=>'已取消'];
            }
        }


    }

    //点赞
    public function ok(){
        if(!Request::isAjax()){
            return ['status'=>-1,'message'=>'请求类型错误'];
        }
        //获取从前端传递过来的数据
        $data = Request::param();
        //判断用户是否为空
        if(empty($data['session_id'])){
            return ['status'=>-2,'message'=>'请登录后在点赞'];
        }else{
            //查询条件
            $map[] = ['user_id','=',$data['user_id']];
            $map[] = ['art_id','=',$data['art_id']];
            $like = Db::table('user_like')->where($map)->find();
            if(is_null($like)){
                Db::table('user_like')->data([
                    'user_id'=>$data['user_id'],
                    'art_id'=>$data['art_id'],
                ])->insert();
                return ['status'=>1,'message'=>'点赞成功'];
            }else{
                Db::table('user_like')->where($map)->delete();
                return ['status'=>0,'message'=>'已取消'];
            }
        }
    }

        //评论
        public function insertComment(){
            if(Request::isAjax()){
                $data = Request::param();
                if(Comment::create($data,true)){
                    return ['status'=>1,'message'=>'评论成功'];
                }
                    return ['status'=>0,'message'=>'评论失败'];
            }

        }

}
