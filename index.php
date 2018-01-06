<?php MainHead('Главная страница')?>
<body>

<div class="wrapper">
<div id="content">
<?php
menuAndLogo(); 
MessageShow(); Left(); ?><div id="Page">
<hr>
<br>
<div id="Slide">
<section>
        <div id="viewport-shadow">

          <a href="#" id="prev" title="go to the next slide"></a>
          <a href="#" id="next" title="go to the next slide"></a>

          <div id="viewport">
            <div id="box">
              <figure class="slide">
                <img src="/resource/img/the-battle.jpg">
              </figure>
              <figure class="slide">
                <img src="/resource/img/hiding-the-map.jpg">
              </figure>
              <figure class="slide">
                <img src="/resource/img/theres-the-buoy.jpg">
              </figure>
              <figure class="slide">
                <img src="/resource/img/finding-the-key.jpg">
              </figure>
              <figure class="slide">
                <img src="/resource/img/lets-get-out-of-here.jpg">
              </figure>
            </div>
          </div>

          <div id="time-indicator"></div>
        </div>

        <footer>
          <nav class="slider-controls">
            <ul id="controls">
              <li><a class="goto-slide current" href="#" data-slideindex="0"></a></li>
              <li><a class="goto-slide" href="#" data-slideindex="1"></a></li>
              <li><a class="goto-slide" href="#" data-slideindex="2"></a></li>
              <li><a class="goto-slide" href="#" data-slideindex="3"></a></li>
              <li><a class="goto-slide" href="#" data-slideindex="4"></a></li>
            </ul>
          </nav>
        </footer>
      </section>
    
	  </div>
		<script src="//code.jquery.com/jquery-1.7.2.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/lib/jquery-1.7.2.min.js"><\/script>')</script>
		<script src="/resource/js/box-slider-all.jquery.min.js"></script>
		<script>

		  $(function () {

        var $box = $('#box')
          , $indicators = $('.goto-slide')
          , $effects = $('.effect')
          , $timeIndicator = $('#time-indicator')
          , slideInterval = 5000;

        var switchIndicator = function ($c, $n, currIndex, nextIndex) {
          $timeIndicator.stop().css('width', 0);
          $indicators.removeClass('current').eq(nextIndex).addClass('current');
        };

        var startTimeIndicator = function () {
          $timeIndicator.animate({width: '680px'}, slideInterval);
        };

        // initialize the plugin with the desired settings
        $box.boxSlider({
            speed: 1000
          , autoScroll: true
          , timeout: slideInterval
          , next: '#next'
          , prev: '#prev'
          , pause: '#pause'
          , effect: 'scrollVert3d'
          , blindCount: 15
          , onbefore: switchIndicator
          , onafter: startTimeIndicator
        });

        startTimeIndicator();

        // pagination isn't built in simply because it's easy to
        // roll your own with the plugin API methods
        $('#controls').on('click', '.goto-slide', function (ev) {
          $box.boxSlider('showSlide', $(this).data('slideindex'));
          ev.preventDefault();
        });

        $('#effect-list').on('click', '.effect', function (ev) {
          var $effect = $(this);

          $box.boxSlider('option', 'effect', $effect.data('fx'));
          $effects.removeClass('current');
          $effect.addClass('current');

          switchIndicator(null, null, 0, 0);
          ev.preventDefault();
        });

		  });

		</script>
		<hr>
<br>		
<h1 align="center">Топ-моды</h1>
<br>		
		
<div class="mainCarousel">
				<ul id="carousel" class="elastislide-list">
					<li><a href="#"><span class="tooltip" data-tooltip="Мечи ангела"><img src="/resource/images/small/1.jpg" title="казбек" alt="image01" /></span></a></li>
					<li><a href="#"><span class="tooltip" data-tooltip="мечи демона"><img src="/resource/images/small/2.jpg" alt="image02" /></span></a></li>
					<li><a href="#"><img src="/resource/images/small/1.jpg" alt="image03" /></a></li>
					<li><a href="#"><img src="/resource/images/small/2.jpg" alt="image04" /></a></li>
					<li><a href="#"><img src="/resource/images/small/3.jpg" alt="image05" /></a></li>
					<li><a href="#"><img src="/resource/images/small/4.jpg" alt="image06" /></a></li>
					<li><a href="#"><img src="/resource/images/small/5.jpg" alt="image07" /></a></li>
					<li><a href="#"><img src="/resource/images/small/6.jpg" alt="image08" /></a></li>
					<li><a href="#"><img src="/resource/images/small/7.jpg" alt="image09" /></a></li>
					<li><a href="#"><img src="/resource/images/small/8.jpg" alt="image10" /></a></li>
					<li><a href="#"><img src="/resource/images/small/9.jpg" alt="image11" /></a></li>
					<li><a href="#"><img src="/resource/images/small/12.jpg" alt="image12" /></a></li>
					<li><a href="#"><img src="/resource/images/small/13.jpg" alt="image13" /></a></li>
					<li><a href="#"><img src="/resource/images/small/14.jpg" alt="image14" /></a></li>
					<li><a href="#"><img src="/resource/images/small/15.jpg" alt="image15" /></a></li>
					<li><a href="#"><img src="/resource/images/small/16.jpg" alt="image16" /></a></li>
					<li><a href="#"><img src="/resource/images/small/17.jpg" alt="image17" /></a></li>
					<li><a href="#"><img src="/resource/images/small/18.jpg" alt="image18" /></a></li>
					<li><a href="#"><img src="/resource/images/small/19.jpg" alt="image19" /></a></li>
					<li><a href="#"><img src="/resource/images/small/20.jpg" alt="image20" /></a></li>
				</ul>

			</div>
			
		<script type="text/javascript" src="/resource/js/jquerypp.custom.js"></script>
		<script type="text/javascript" src="/resource/js/jquery.elastislide.js"></script>
		<script type="text/javascript">
			
			$( '#carousel' ).elastislide();
			
		</script>
	<br>
<hr>
<br>		
<h1 align="center">Новые моды на Skyrim</h1>
<br>
	
<div class="mainCarousel">
				<ul id="carousel2" class="elastislide-list">
					<li><a href="#"><span class="tooltip" data-tooltip="Мечи ангела"><img src="/resource/images/small/1.jpg" title="казбек" alt="image01" /></span></a></li>
					<li><a href="#"><span class="tooltip" data-tooltip="мечи демона"><img src="/resource/images/small/2.jpg" alt="image02" /></span></a></li>
					<li><a href="#"><img src="/resource/images/small/3.jpg" alt="image03" /></a></li>
					<li><a href="#"><img src="/resource/images/small/4.jpg" alt="image04" /></a></li>
					<li><a href="#"><img src="/resource/images/small/5.jpg" alt="image05" /></a></li>
					<li><a href="#"><img src="/resource/images/small/6.jpg" alt="image06" /></a></li>
					<li><a href="#"><img src="/resource/images/small/7.jpg" alt="image07" /></a></li>
					<li><a href="#"><img src="/resource/images/small/8.jpg" alt="image08" /></a></li>
					<li><a href="#"><img src="/resource/images/small/9.jpg" alt="image09" /></a></li>
					<li><a href="#"><img src="/resource/images/small/10.jpg" alt="image10" /></a></li>
					<li><a href="#"><img src="/resource/images/small/11.jpg" alt="image11" /></a></li>
					<li><a href="#"><img src="/resource/images/small/12.jpg" alt="image12" /></a></li>
					<li><a href="#"><img src="/resource/images/small/13.jpg" alt="image13" /></a></li>
					<li><a href="#"><img src="/resource/images/small/14.jpg" alt="image14" /></a></li>
					<li><a href="#"><img src="/resource/images/small/15.jpg" alt="image15" /></a></li>
					<li><a href="#"><img src="/resource/images/small/16.jpg" alt="image16" /></a></li>
					<li><a href="#"><img src="/resource/images/small/17.jpg" alt="image17" /></a></li>
					<li><a href="#"><img src="/resource/images/small/18.jpg" alt="image18" /></a></li>
					<li><a href="#"><img src="/resource/images/small/19.jpg" alt="image19" /></a></li>
					<li><a href="#"><img src="/resource/images/small/20.jpg" alt="image20" /></a></li>
				</ul>

			</div>
			
		<script type="text/javascript" src="/resource/js/jquerypp.custom.js"></script>
		<script type="text/javascript" src="/resource/js/jquery.elastislide.js"></script>
		<script type="text/javascript">
			
			$( '#carousel2' ).elastislide();
			
		</script>
	<br>
<hr>
<br>		
<h1 align="center">Новые моды на Oblivion</h1>
<br>
	
<div class="mainCarousel">
				<ul id="carousel3" class="elastislide-list">
					<li><a href="#"><span class="tooltip" data-tooltip="Мечи ангела"><img src="/resource/images/small/8.jpg" title="казбек" alt="image01" /></span></a></li>
					<li><a href="#"><span class="tooltip" data-tooltip="мечи демона"><img src="/resource/images/small/7.jpg" alt="image02" /></span></a></li>
					<li><a href="#"><img src="/resource/images/small/1.jpg" alt="image03" /></a></li>
					<li><a href="#"><img src="/resource/images/small/2.jpg" alt="image04" /></a></li>
					<li><a href="#"><img src="/resource/images/small/3.jpg" alt="image05" /></a></li>
					<li><a href="#"><img src="/resource/images/small/4.jpg" alt="image06" /></a></li>
					<li><a href="#"><span class="tooltip" data-tooltip="Мечи ангела"><img src="/resource/images/small/5.jpg" title="казбек" alt="image01" /></span></a></li>
					<li><a href="#"><img src="/resource/images/small/6.jpg" alt="image08" /></a></li>
					<li><a href="#"><img src="/resource/images/small/7.jpg" alt="image09" /></a></li>
					<li><a href="#"><img src="/resource/images/small/8.jpg" alt="image10" /></a></li>
					<li><a href="#"><img src="/resource/images/small/9.jpg" alt="image11" /></a></li>
					<li><a href="#"><img src="/resource/images/small/12.jpg" alt="image12" /></a></li>
					<li><a href="#"><img src="/resource/images/small/13.jpg" alt="image13" /></a></li>
					<li><a href="#"><img src="/resource/images/small/14.jpg" alt="image14" /></a></li>
					<li><a href="#"><img src="/resource/images/small/15.jpg" alt="image15" /></a></li>
					<li><a href="#"><img src="/resource/images/small/16.jpg" alt="image16" /></a></li>
					<li><a href="#"><img src="/resource/images/small/17.jpg" alt="image17" /></a></li>
					<li><a href="#"><img src="/resource/images/small/18.jpg" alt="image18" /></a></li>
					<li><a href="#"><img src="/resource/images/small/19.jpg" alt="image19" /></a></li>
					<li><a href="#"><img src="/resource/images/small/20.jpg" alt="image20" /></a></li>
				</ul>

			</div>
			
		<script type="text/javascript" src="/resource/js/jquerypp.custom.js"></script>
		<script type="text/javascript" src="/resource/js/jquery.elastislide.js"></script>
		<script type="text/javascript">
			
			$( '#carousel3' ).elastislide();
			
		</script>	
	<br>
<hr>
<br>		
<h1 align="center">Новые моды на Morrowind</h1>
<br>
	
<div class="mainCarousel">
				<ul id="carousel4" class="elastislide-list">
					<li><a href="#"><span class="tooltip" data-tooltip="Мечи ангела"><img src="/resource/images/small/1.jpg" title="казбек" alt="image01" /></span></a></li>
					<li><a href="#"><span class="tooltip" data-tooltip="мечи демона"><img src="/resource/images/small/2.jpg" alt="image02" /></span></a></li>
					<li><a href="#"><img src="/resource/images/small/3.jpg" alt="image03" /></a></li>
					<li><a href="#"><img src="/resource/images/small/4.jpg" alt="image04" /></a></li>
					<li><a href="#"><img src="/resource/images/small/5.jpg" alt="image05" /></a></li>
					<li><a href="#"><img src="/resource/images/small/6.jpg" alt="image06" /></a></li>
					<li><a href="#"><img src="/resource/images/small/7.jpg" alt="image07" /></a></li>
					<li><a href="#"><img src="/resource/images/small/8.jpg" alt="image08" /></a></li>
					<li><a href="#"><img src="/resource/images/small/9.jpg" alt="image09" /></a></li>
					<li><a href="#"><img src="/resource/images/small/10.jpg" alt="image10" /></a></li>
					<li><a href="#"><img src="/resource/images/small/11.jpg" alt="image11" /></a></li>
					<li><a href="#"><img src="/resource/images/small/12.jpg" alt="image12" /></a></li>
					<li><a href="#"><img src="/resource/images/small/13.jpg" alt="image13" /></a></li>
					<li><a href="#"><img src="/resource/images/small/14.jpg" alt="image14" /></a></li>
					<li><a href="#"><img src="/resource/images/small/15.jpg" alt="image15" /></a></li>
					<li><a href="#"><img src="/resource/images/small/16.jpg" alt="image16" /></a></li>
					<li><a href="#"><img src="/resource/images/small/17.jpg" alt="image17" /></a></li>
					<li><a href="#"><img src="/resource/images/small/18.jpg" alt="image18" /></a></li>
					<li><a href="#"><img src="/resource/images/small/19.jpg" alt="image19" /></a></li>
					<li><a href="#"><img src="/resource/images/small/20.jpg" alt="image20" /></a></li>
				</ul>

			</div>
			
		<script type="text/javascript" src="/resource/js/jquerypp.custom.js"></script>
		<script type="text/javascript" src="/resource/js/jquery.elastislide.js"></script>
		<script type="text/javascript">
			
			$( '#carousel4' ).elastislide();
			
		</script>
<br>		
<hr>
<h2 align="center">Кто онлайн?</h2>
<hr>

<?php 
$UserOnline = mysqli_query($CONNECT, 'SELECT `user` FROM `online`');

$u0 = 0;
$u1 = 0;
while ($Data = mysqli_fetch_assoc($UserOnline)) {
	if ($Data['user'] == 'Гость') 
		$u0 += 1;
	else $u1 += 1;
	
	if ($Data['user'] != 'Гость')
	$u_list .= '<a href="/user/'.$Data['user'].'" class="edit">'.$Data['user'].'</a>, ';
} 

	if ($u_list) 
		$u_list = ' [ '.substr($u_list, 0, -2).' ]';

	echo '<br><br><p align="center" class="description">Гостей: '.$u0.' | Пользователей: '.$u1.$u_list.'</p>.';

?>
</div>
<?php Footer(); ?>
</div>
</div>
</body>
</html>