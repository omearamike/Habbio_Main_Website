<!-- Influencer Post Template -->

<?php
	/**
	 * Wp in Progress
	 *
	 * @author WPinProgress
	 *
	 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
	 * It is also available at this URL: http://www.gnu.org/licenses/gpl-3.0.txt
	 */
	get_header();
?>

<div class="container content">

    <div class="row">

            <div class="row">

								<!-- Start of Profile -->
                <article <?php post_class(); ?> >
                    <?php while ( have_posts() ) : the_post(); ?>

	<!-- Start of Profile Header Section -->
				<div class="profileHeader">

					<div class="sitePage">
						<h1>Influencer//</h1>
					</div>

						<div class="profileImg">

								<img src="/Habiio/wp-content/uploads/2016/05/joeWicks_ProfileImage.png" alt="Arianna Huffington_Transparent" />

						</div>
						<div class="descriptionBox">

							<div class="postTitle">

								<h1> <?php echo get_the_title(); ?> </h1>

							</div>

							<div class="profileCaption">

								 <h2>I'm a man on a mission to rescue people from the awful dieting industry. I am sick and tired of people struggling on low calorie diets and meal replacement shakes.</h2>

							</div>


						</div>
					</div>
<!-- End of Profile header section -->

<!-- Start of Habit Section -->
				 <div id="habitSection" class="habitSection">
					 <div class="habitHeader">
				 		<div class="morningBox">
							<div class="habitCard">
								<div class="innerCard">
											<div class="innerContainer">
								<div class="cardTitle">
									<h1>Morning Habits - Press ups</h1>
								</div>

								<div class="leftContent">
									<p>Joe Wicks is an onlin
Joe's philosophy to health and fin energy and transf </p>
<li>Eat Porrige</li>
<li>Press ups</li>

<p>Joe Wicks is an onlur macronutrients to ensure your body burns fat, increases in energy and transf </p> 
								</div>

								<div class="rightContent">

									<img src="/Habiio/wp-content/uploads/2016/05/Joe-Wicks-The-Body-Coach-Skipping1200x976-790x500.jpg" alt="Arianna Huffington_Transparent" />

								</div>
							</div>

						</div>
					</div>
						</div>

						<!-- <div class="eveningBox">
							<div class="habitCard">
								<div class="habitBox eveningTitleBox">
									<h2> Evening Habits </h2>
								</div>
								<div class="habitContent" id="eveningContent">
								<h1 class="habitTitle">Evening</h1>
								<p id="articleContent" class="habitBlog">
								</p>
							</div>
							</div>
						</div> -->


						<!-- <div class="afternoonBox">
							<div class="habitCard">
							<div class="habitBox afternoonTitleBox">
								<h2> Afternoon Habits </h2>
							</div>
							<div class="habitContent" id="afternoonContent">
							<h1 class="habitTitle"></h1>
							<div class="leftContent">
								"this is the left ocntent"
							</div>
							<div class="rightContent">

							</div>
							<p id="articleContent" class="habitBlog"> Evening contenetkljfdsdf sjfds
		<iframe width="560" height="315" src="https://www.youtube.com/embed/yuJTAUKUOYc" frameborder="0" allowfullscreen></iframe>
		top and drizzle with honey.Put the oats in a saucepan, pour in the milk or water and sprinkle in a pinch of salt. Bring to the boil and simmer for 4-5 minutes, stirring from time to time and watching carefully that it doesn’t stick to the bottom of the pan. Or you can try this in a microwave. Mix the oats, milk or water and a pinch of salt in a large microwaveproof bowl, then microwave on High for 5 minutes, stirring halfway through. Leave to stand for 2 minutes before eating.

							</p>
						</div>
							</div>
						</div> -->
					</div>
					</div>


						<div class="habitArticle">







				</div>
<!-- End of habit section -->



					<?php
							/*
							* Set the post format of a post (in the loop).
							*/
							set_post_format($post->ID, 'image' ); //sets the given post to the 'image' format

					?>

            </article>

        </div>

		<?php

			endwhile;

		?>

    </div>

</div>
<!-- End of Content -->

<?php
	get_footer();
?>
