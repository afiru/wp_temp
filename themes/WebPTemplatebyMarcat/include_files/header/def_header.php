<!DOCTYPE html>
<html>
<head>
<?php echo get_php_customzer('google_analytics'); ?>
<?php if(is_page(array('thanks'))): ?>
    <?php echo get_php_customzer('thanks_cvc_tag'); ?>
<?php endif; ?>
<meta charset="UTF-8">
<meta content="text/css" http-equiv="Content-Style-Type" />
<meta content="text/javascript" http-equiv="Content-Script-Type" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta http-equiv="expires" content="86400">
<meta http-equiv="Content-Language" content="ja">
<meta name="Robots" content="noodp">
<meta name="Author" content="Marcatucube">
<meta name="copyright" content="" />
<meta name="viewport" content="viewport-fit=cover,width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<?php //タイトルの設定。【トップページ】カスタマイザーのSEOタイトル　【下層】ページタイトル｜カスタマイザーのSEOタイトル　 ?>
<title><?php echo get_the_site_title(get_php_customzer('seo_title')); ?></title>
<?php //キーワードの設定。カスタマイザーのキーワード内容。　ページ別にそれぞれ設定する場合は、ALL in one seo packageを使用　 ?>
<meta name="keywords" content="<?php echo get_php_customzer('keywords'); ?>" />
<?php //ディスクリプションの設定。　ページ別にそれぞれ設定する場合は、ALL in one seo packageを使用　 ?>
<meta name="description" content="<?php echo get_php_customzer('description'); ?>" />

<style><?php echo file_get_contents(get_bloginfo('template_url').'/css/first_view.css'); ?><?php get_template_part('header_fv'); ?></style>
<?php wp_head(); ?>
<script>
!function(A,n,e){function a(A,n){return typeof A===n}function o(){var A,n,e,o,i,t,r;for(var f in l)if(l.hasOwnProperty(f)){if(A=[],n=l[f],n.name&&(A.push(n.name.toLowerCase()),n.options&&n.options.aliases&&n.options.aliases.length))for(e=0;e<n.options.aliases.length;e++)A.push(n.options.aliases[e].toLowerCase());for(o=a(n.fn,"function")?n.fn():n.fn,i=0;i<A.length;i++)t=A[i],r=t.split("."),1===r.length?Modernizr[r[0]]=o:(!Modernizr[r[0]]||Modernizr[r[0]]instanceof Boolean||(Modernizr[r[0]]=new Boolean(Modernizr[r[0]])),Modernizr[r[0]][r[1]]=o),s.push((o?"":"no-")+r.join("-"))}}function i(A){var n=c.className,e=Modernizr._config.classPrefix||"";if(u&&(n=n.baseVal),Modernizr._config.enableJSClass){var a=new RegExp("(^|\\s)"+e+"no-js(\\s|$)");n=n.replace(a,"$1"+e+"js$2")}Modernizr._config.enableClasses&&(n+=" "+e+A.join(" "+e),u?c.className.baseVal=n:c.className=n)}function t(A,n){if("object"==typeof A)for(var e in A)f(A,e)&&t(e,A[e]);else{A=A.toLowerCase();var a=A.split("."),o=Modernizr[a[0]];if(2==a.length&&(o=o[a[1]]),"undefined"!=typeof o)return Modernizr;n="function"==typeof n?n():n,1==a.length?Modernizr[a[0]]=n:(!Modernizr[a[0]]||Modernizr[a[0]]instanceof Boolean||(Modernizr[a[0]]=new Boolean(Modernizr[a[0]])),Modernizr[a[0]][a[1]]=n),i([(n&&0!=n?"":"no-")+a.join("-")]),Modernizr._trigger(A,n)}return Modernizr}var s=[],l=[],r={_version:"3.6.0",_config:{classPrefix:"",enableClasses:!0,enableJSClass:!0,usePrefixes:!0},_q:[],on:function(A,n){var e=this;setTimeout(function(){n(e[A])},0)},addTest:function(A,n,e){l.push({name:A,fn:n,options:e})},addAsyncTest:function(A){l.push({name:null,fn:A})}},Modernizr=function(){};Modernizr.prototype=r,Modernizr=new Modernizr;var f,c=n.documentElement,u="svg"===c.nodeName.toLowerCase();!function(){var A={}.hasOwnProperty;f=a(A,"undefined")||a(A.call,"undefined")?function(A,n){return n in A&&a(A.constructor.prototype[n],"undefined")}:function(n,e){return A.call(n,e)}}(),r._l={},r.on=function(A,n){this._l[A]||(this._l[A]=[]),this._l[A].push(n),Modernizr.hasOwnProperty(A)&&setTimeout(function(){Modernizr._trigger(A,Modernizr[A])},0)},r._trigger=function(A,n){if(this._l[A]){var e=this._l[A];setTimeout(function(){var A,a;for(A=0;A<e.length;A++)(a=e[A])(n)},0),delete this._l[A]}},Modernizr._q.push(function(){r.addTest=t}),Modernizr.addAsyncTest(function(){var A=new Image;A.onerror=function(){t("webpalpha",!1,{aliases:["webp-alpha"]})},A.onload=function(){t("webpalpha",1==A.width,{aliases:["webp-alpha"]})},A.src="data:image/webp;base64,UklGRkoAAABXRUJQVlA4WAoAAAAQAAAAAAAAAAAAQUxQSAwAAAABBxAR/Q9ERP8DAABWUDggGAAAADABAJ0BKgEAAQADADQlpAADcAD++/1QAA=="}),Modernizr.addAsyncTest(function(){var A=new Image;A.onerror=function(){t("webpanimation",!1,{aliases:["webp-animation"]})},A.onload=function(){t("webpanimation",1==A.width,{aliases:["webp-animation"]})},A.src="data:image/webp;base64,UklGRlIAAABXRUJQVlA4WAoAAAASAAAAAAAAAAAAQU5JTQYAAAD/////AABBTk1GJgAAAAAAAAAAAAAAAAAAAGQAAABWUDhMDQAAAC8AAAAQBxAREYiI/gcA"}),Modernizr.addAsyncTest(function(){function A(A,n,e){function a(n){var a=n&&"load"===n.type?1==o.width:!1,i="webp"===A;t(A,i&&a?new Boolean(a):a),e&&e(n)}var o=new Image;o.onerror=a,o.onload=a,o.src=n}var n=[{uri:"data:image/webp;base64,UklGRiQAAABXRUJQVlA4IBgAAAAwAQCdASoBAAEAAwA0JaQAA3AA/vuUAAA=",name:"webp"},{uri:"data:image/webp;base64,UklGRkoAAABXRUJQVlA4WAoAAAAQAAAAAAAAAAAAQUxQSAwAAAABBxAR/Q9ERP8DAABWUDggGAAAADABAJ0BKgEAAQADADQlpAADcAD++/1QAA==",name:"webp.alpha"},{uri:"data:image/webp;base64,UklGRlIAAABXRUJQVlA4WAoAAAASAAAAAAAAAAAAQU5JTQYAAAD/////AABBTk1GJgAAAAAAAAAAAAAAAAAAAGQAAABWUDhMDQAAAC8AAAAQBxAREYiI/gcA",name:"webp.animation"},{uri:"data:image/webp;base64,UklGRh4AAABXRUJQVlA4TBEAAAAvAAAAAAfQ//73v/+BiOh/AAA=",name:"webp.lossless"}],e=n.shift();A(e.name,e.uri,function(e){if(e&&"load"===e.type)for(var a=0;a<n.length;a++)A(n[a].name,n[a].uri)})}),o(),i(s),delete r.addTest,delete r.addAsyncTest;for(var p=0;p<Modernizr._q.length;p++)Modernizr._q[p]();A.Modernizr=Modernizr}(window,document);
    if (Modernizr.history) {}
Modernizr.on('webp', function (result) { if (result) {obj = document.getElementsByTagName("body")[0];obj.classList.add("has_webp"); }
else {obj = document.getElementsByTagName("body")[0];	obj.classList.add("no_webp");  }});
var call = function(src, handler){var base = document.getElementsByTagName("script")[0];var obj = document.createElement("script");obj.async = true;obj.src= src;if(obj.addEventListener){obj.onload = function () {handler();}}else{obj.onreadystatechange = function () {if ("loaded" == obj.readyState || "complete" == obj.readyState){obj.onreadystatechange = null;handler();}}}base.parentNode.insertBefore(obj,base);};
</script>
<link rel="preload" href="<?php echo get_bloginfo('template_url'); ?>/css/basestyle.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/css/basestyle.css"></noscript>
<script>
	!function(t){"use strict";t.loadCSS||(t.loadCSS=function(){});var e=loadCSS.relpreload={};if(e.support=function(){var e;try{e=t.document.createElement("link").relList.supports("preload")}catch(a){e=!1}return function(){return e}}(),e.bindMediaToggle=function(t){function e(){t.addEventListener?t.removeEventListener("load",e):t.attachEvent&&t.detachEvent("onload",e),t.setAttribute("onload",null),t.media=a}var a=t.media||"all";t.addEventListener?t.addEventListener("load",e):t.attachEvent&&t.attachEvent("onload",e),setTimeout(function(){t.rel="stylesheet",t.media="only x"}),setTimeout(e,3e3)},e.poly=function(){if(!e.support())for(var a=t.document.getElementsByTagName("link"),n=0;n<a.length;n++){var o=a[n];"preload"!==o.rel||"style"!==o.getAttribute("as")||o.getAttribute("data-loadcss")||(o.setAttribute("data-loadcss",!0),e.bindMediaToggle(o))}},!e.support()){e.poly();var a=t.setInterval(e.poly,500);t.addEventListener?t.addEventListener("load",function(){e.poly(),t.clearInterval(a)}):t.attachEvent&&t.attachEvent("onload",function(){e.poly(),t.clearInterval(a)})}"undefined"!=typeof exports?exports.loadCSS=loadCSS:t.loadCSS=loadCSS}("undefined"!=typeof global?global:this);
</script>
</head>
<body id="page_top">
<div id="page_wapper_master">
<?php echo get_php_customzer('body_after_code'); ?>
<div id="scroll_off" class="base_header">
    <?php get_template_part('include_files/header/header_pc'); ?>
    <?php get_template_part('include_files/header/header_sp'); ?>
</div>
<div id="scroll_on" class="base_header">
    <?php get_template_part('include_files/header/header_pc'); ?>
    <?php get_template_part('include_files/header/header_sp'); ?>
</div>