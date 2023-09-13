<?php
	while( have_posts() ): the_post();
//		the_title('<h1 class="text-center texto-primary">','</h1>');
		if(has_post_thumbnail()){
			the_post_thumbnail();
		}
		the_content();
	endwhile;
