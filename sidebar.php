    <div id="sidebar">
        <ul>
            <?php if (function_exists('dynamic_sidebar')&&dynamic_sidebar()):else://检测到可以使用拖拽边栏，则使用拖拽，拖拽内容在外观->小工具里，要显示拖拽内容要创立functions.php文件?>
            <li id="search">
                <?php include(TEMPLATEPATH.'/searchform.php');//创建搜索框，要创建searchform.php,TEMPLATEPATH是主题文件夹的文职，这里是wp-content/themes/soyking?>
            </li>
            <?php wp_list_pages('depth=3&title_li=<h2>页面</h2>');//显示创建的页面，会自动附上<ul><li>标签,depth表示最多显示的父子关系为几层，title_li用来制定链接列表标题的参数?>
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
            <?php wp_list_bookmarks('title_li=<h2>链接</h2>'); //显示书签，首先要在/wordpress/wp-admin/link-manager.php安装链接插件,title_li同上，用来制定样式?>
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