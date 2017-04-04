/**
 * Created by gongbiao on 4/4/17.
 */
/*定义一个全局变量*/
window.jdshop = {}; /*存储 我们将要封闭的 事件方法*/
/*设置 属性 定义一个 transitionEnd 一个事件绑定方法*/
jdshop.transitionEnd = function (dom, callback){
    /**
     * 过渡结束事件的绑定
     * 1.谁需要绑定 transitionEnd
     * 2.需要处理的函数
     */
    if(dom && typeof dom === 'object'){
        dom.addEventListener('webkitTransitionEnd',function(){
            /* if(callback){
             callback();
             }*/
            callback && callback();
        });
        dom.addEventListener('transitionEnd',function(){
            callback && callback();
        });
    }
}


