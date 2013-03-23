<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">

    <title><?php bloginfo('name'); ?><?php wp_title(); ?></title>

    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" /> 
    <meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats please -->

    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
    <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
    <link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
    <link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

    <?php wp_get_archives('type=monthly&format=link'); ?>
    <?php //comments_popup_script(); // off by default ?>
    <?php wp_head(); ?>
</head>
<body>
    <div id="header">
        <h1><a href="<?php bloginfo('url');//主页的地址?>"><?php bloginfo('name')//主页名字?></a></h1>
        <?php bloginfo('description');//主页的介绍?>
        </div>
    <div id="container">
        <?php if (have_posts())://判断是否有文章，注意冒号?>
        <?php while(have_posts()):the_post()//循环读出文章，注意冒号?>
        <div id="post">
            <h2><a href="<?php the_permalink();//每篇文章的链接?>"><?php the_title();//文章的标题?></a></h2>
        </div>
        <div class="entry">
            <h3>
                <?//php the_content();//文章的内容?>
                <?//php the_excerpt();//显示55个字符，剩下内容点击标题继续阅读?>
                <?php 
                    $more_link_text="read more……";//阅读更多的链接上的文字
                    $strip_teaser=false;//设置为true以后点开链接前面的内容没法看见
                    $more_file='';//链接到当前日志文件
                    the_content($more_link_text,$strip_teaser,$more_file);//实现显示一部分内容，要先在写日志的时候创立<!--more-->标签 
                ?>
            </h3>
            <p class="postmetadata"><!--这一大段不明觉厉，用来显示归属哪个分类，有多少条评论，作者是谁，_e用来输出，使内容可翻译-->
                <?php _e('Filed under:'); ?> 
                <?php the_category(', ') //所属类别，属于不止一个类别用，分开?> 
                <?php _e('by'); ?> 
                <?php  the_author(); //作者?><br />
                <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); //显示评论。三个参数分别是没有评论时的显示，一条评论时的显示（comment单数），多条评论时的显示，&#187表示符号>>?> 
                <?php edit_post_link('Edit', ' &#124; ', '');//显示编辑，三个参数分别是链接的显示（比如“编辑”），前面的符号（&#124表示|），链接后面的字符?>
            </p>
        </div>
        <?php endwhile;?>
        <div class=”navigation”>
        <?php posts_nav_link(' now ','before','after'); //分页导航，三个参数分别是上一页链接，这一页，下一页链接的显示字符?>
        </div>
        <?php else:?>
        <div class="post">
            <h2><?php _e('sorry,the blogger have not launch any articles');//没有文章发表时的显示?></h2>
        </div>
        <?php endif;?>
    </div>
    <div id="sidebar">
        <ul>
            <?php if (function_exists('dynamic_sidebar')&&dynamic_sidebar()):else://检测到可以使用拖拽边栏，则使用拖拽，拖拽内容在外观->小工具里，要显示拖拽内容要创立functions.php文件?>
            <li id="search">
                <?php include(TEMPLATEPATH.'/searchform.php');//创建搜索框，要创建searchform.php,TEMPLATEPATH是主题文件夹的文职，这里是wp-content/themes/soyking?>
            </li>
            <?php wp_list_pages('depth=3&title_li=<h2 style="color:blue;">页面</h2>');//显示创建的页面，会自动附上<ul><li>标签,depth表示最多显示的父子关系为几层，title_li用来制定链接列表标题的参数?>
            <li>
                <h2><?php _e('Categories');?></h2>
                <ul>
                    <?php wp_list_cats('sort_column=name&optioncount=1&hierarchical=0');//name按分类字符顺序排列，optioncount=1显示每个分类含有的日志数，hierarchial=0不按层式显示子分类，&用来区分参数,该函数会自动附上<li>标签?>
                </ul>
            </li>
            <li>
                <h2><?php _e('Archives')?></h2>
                <ul>
                    <?php wp_get_archives('type=monthly');//文章归档，默认以月份分类,可以daily以天分类，yearly以年分类?>
                </ul>
            </li>
            <?php wp_list_bookmarks('title_li=<h2 style="color:red;">链接</h2>'); //显示书签，首先要在/wordpress/wp-admin/link-manager.php安装链接插件,title_li同上，用来制定样式?>
            <li>
                <h2><?php _e('Meta');?></h2>
                <ul>
                    <?php wp_register();//登陆?>
                    <li><?php wp_loginout();//登出?></li>
                    <?php wp_meta();?>
                </ul>
            </li>
            <li id="calendar">
                <h2><?php _e('Calendar');?></h2>
                <?php get_calendar();//输出日历，可以通过日历查日志?>
            <?php endif;?>
        </ul>
    </div>
</body>
</html>