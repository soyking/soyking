<?php get_header();?>    
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
        <div class="navigation">
        <?php posts_nav_link(' now ','before','after'); //分页导航，三个参数分别是上一页链接，这一页，下一页链接的显示字符?>
        </div>
        <?php else:?>
        <div class="post">
            <h2><?php _e('sorry,the blogger has not launched any articles');//没有文章发表时的显示?></h2>
        </div>
        <?php endif;?>
    </div>
    <?php get_sidebar();?>
    <?php get_footer();?>
</div>
</body>
</html>