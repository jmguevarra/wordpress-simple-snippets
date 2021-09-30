<?php
/**
* Template Name: Course Post
* Template Post Type: course
*
* @package WordPress
* @subpackage Twenty_Fourteen
* @since Twenty Fourteen 1.0
*/

/*
Project URL: https://buildersacademy.com.au/course
Description: 
Courses with help ACF fields with repeater. It also includes marketor form

*/
get_header(); ?>

  <?php
    // Start the Loop.
    while ( have_posts() ) : the_post();


    ?>

<div class="course-single-new">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-8 courses-content">
              <div class="course-content top">
                    <span class="course-title-fields"></span>
                    <div class="course-title">
                        <h1 class="title-wrap">
                            <?php if ( get_field('alternate_course_title') ) : ?>
                                <?php the_field('alternate_course_title'); ?>
                            <?php else: ?>
                                <?php the_title(); ?>
                            <?php endif;?>
                        </h1>
                        <?php if ( get_field('course_fields') || get_field('course_code') ) : ?>
                            <span class="title-code-wrap"><?php the_field('course_fields'); ?> | <?php the_field('course_code') ?></span>
                        <?php endif; ?>
                    </div>
                    <?php if ( get_field('course_feature_image') ) : ?>
                        <a class="course-feature-image" href="<?php the_field('course_feature_image'); ?>">
                            <img src="<?php the_field('course_feature_image'); ?>">
                        </a>
                    <?php endif; ?>
                    <div id="download-section" class="course-single-description">
                        <?php if (get_field('job_outcome')): ?>
                            <div>
                                <span class="ic"><img src="/wp-content/uploads/2019/12/bag-icon-blue.svg"></span>
                                <span>Job Outcome: </span>
                                <?php the_field('job_outcome'); ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (get_field('delivery_model')): ?>
                            <div>
                                <span class="ic"><img src="/wp-content/uploads/2020/01/monitor-blue.svg"></span>
                                <span>Delivery Model: </span>
                                <?php the_field('delivery_model'); ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (get_field('estimated_salary')): ?>
                            <div>
                                <span class="ic"><img src="/wp-content/uploads/2019/12/dollar-icon-blue.svg"></span>
                                <span>Estimated Salary: </span>
                                <?php the_field('estimated_salary'); ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (get_field('funding_options')): ?>
                            <div>
                                <span class="ic"><img src="/wp-content/uploads/2020/01/fund-blue.svg"></span>
                                <span>Funding Options: </span>
                                <?php the_field('funding_options'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
				   
                    <?php if ( get_field('brochure') ): ?>
                        <a target="_blank" href="<?php the_field('brochure') ?>" class="popup-download btn"><?php the_field('cta_text'); ?></a>
				  	<?php elseif ( get_field('cta_link') ): ?>
                        <a target="_blank" href="<?php the_field('cta_link') ?>" class="cta-link btn"><?php the_field('cta_text'); ?></a>
                    <?php endif; ?>
				  
                </div>
                <div class="course-content bottom">
                    <?php if ( get_field('short_content') ) :?>
                        <div class="short-content">
                            <?php the_field('short_content'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="course-accordion">
                        <?php if ( get_field('study_your_diploma')) : ?>
                            <div class="course-accordion-item study-your-diploma active">
                                <div class="course-accordion-toggle"><?php the_field('study_your_diploma_title'); ?></div>
                                <div class="course-accordion-content">
                                    <?php the_field('study_your_diploma'); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ( get_field('about_course_title')) : ?>
                            <div class="course-accordion-item about-course">
                                <div class="course-accordion-toggle"><?php the_field('about_course_title'); ?></div>
                                <div class="course-accordion-content">
                                    <?php the_field('about_course_content') ?>
                                    <?php if( have_rows('about_course_more_content') ):
                                        // loop through the rows of data
                                        while ( have_rows('about_course_more_content') ) : the_row(); ?>
                                            <div class="course-about-more">
                                                <?php if (get_sub_field('about_more_title')): ?>
                                                <h4><?php the_sub_field('about_more_title')?></h4>
                                                <?php endif; ?>
                                                <p><?php the_sub_field('about_more_content')?></p>
                                            </div>
                                        <?php endwhile;
                                    endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ( get_field('mentoring_program_content')) : ?>
                            <div class="course-accordion-item mentoring-program">
                                <div class="course-accordion-toggle"><?php the_field('mentoring_program_title'); ?></div>
                                <div class="course-accordion-content">
                                    <?php the_field('mentoring_program_content'); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ( get_field('fees')) : ?>
                            <div class="course-accordion-item fees">
                                <div class="course-accordion-toggle"><?php the_field('fees_title'); ?></div>
                                <div class="course-accordion-content">
                                    <?php the_field('fees'); ?>
                                </div>
                            </div>
                        <?php endif; ?>
						
						<?php if( have_rows('faq_repeater') ):  ?>
							<div class="course-accordion-item faq-courses">
                                <div class="course-accordion-toggle"><?php the_field('faq_title'); ?></div>
                                <div class="course-accordion-content">
									<div class="faq-accordian">
										<?php while( have_rows('faq_repeater') ): the_row(); ?>
											<div class="faq-accordian-toggle"><?php the_sub_field('faq_question'); ?></div>
											<div class="faq-accordian-content">
												<?php the_sub_field('faq_answer'); ?>
											</div>
										<?php endwhile; ?>
									</div>
                                </div>
                            </div>
						<?php endif; ?>
						
						<?php if ( get_field('disclaimer')) : ?>
                            <div class="disclaimer">
                                <p>
                                    <?php the_field('disclaimer'); ?>
                                </p>
                            </div>
                        <?php endif; ?>
					
                   </div>
        </div>
      </div>
      <div class="col-xs-12 col-sm-4 course-sidebar">
        <?php
        if(get_field('alternate_layout')==true){

          if( have_rows('right_column_links') ){
            ?>
            <div class="course-right-links">
            <?php

            while ( have_rows('right_column_links') ) { the_row();

              $link = "";
              $link_track_cat = get_sub_field('link_event_tracking_category');
              $link_track_label = get_sub_field('link_event_tracking_label');

              if(get_sub_field("link_type")=="internal"){
                $link = get_sub_field("internal_link");
                $link = get_permalink($link->ID);
              }elseif(get_sub_field("link_type")=="external"){
                $link = get_sub_field("external_link");
              }elseif(get_sub_field("link_type")=="internal_text"){
                $link = get_sub_field("internal_text");
              }

              if(get_sub_field("link_display_type")=="text"){
                ?>
                  <p class="enrol-sub"><a href="<?php echo $link; ?>" <?php if(get_sub_field("link_type")=="external"){ ?> target="_blank" onclick="trackOutboundLink('<?php echo $link; ?>'); return false;"<?php } ?>><?php the_sub_field("link_text"); ?></a></p>
                <?php
              }elseif(get_sub_field("link_display_type")=="blue"){
                ?>
                <a href="<?php echo $link; ?>" class="blue-button" <?php if(get_sub_field("link_type")=="external"){ ?>target="_blank"
                  <?php if($link_track_cat != "" && $link_track_label !="" ) { ?>
                    onclick="ga('send', 'event', '<?php echo $link_track_cat ?>', 'click', '<?php echo $link_track_label ?>');"
                  <?php }else{ ?>
                    onclick="trackOutboundLink('<?php echo $link; ?>'); return false;"
                  <?php } ?>
                <?php } ?>><?php the_sub_field("link_text"); ?></a>
                <?php
              }elseif(get_sub_field("link_display_type")=="white"){
                ?>
                <a href="<?php echo $link; ?>" class="white-button" <?php if(get_sub_field("link_type")=="external"){ ?>target="_blank" onclick="trackOutboundLink('<?php echo $link; ?>'); return false;" <?php } if($link_track_cat !=""){ ?> onClick="_gaq.push(['_trackEvent', '<?php echo $link_track_cat ?>', 'Click', ‘<?php echo $link_track_label ?>']);"<?php } ?>><?php the_sub_field("link_text"); ?></a>
                <?php
              }
            }

            ?></div><?php
          }
        }
        ?>

        <div id="course-form" class="single course-form-container">
          <div class="course-form-heading alternate-layout">Want to know if this course is right for you?</div>
          <div class="form-list">
            <ul>
              <li>See if you’re eligible for funding</li>
              <li>Estimated salary</li>
              <li>Delivery model: <?php the_field('delivery_model'); ?></li>
            </ul>
          </div>
          <div class="course-form alternate-layout">
            <?php


            // if(isset($_GET['other_form']) && $_GET['other_form']=='true'){
            if(get_field('third_party_form')){
              the_field('third_party_form');
            }else{
              $form = get_field('contact_form');
              gravity_form_enqueue_scripts($form->id, true);
              gravity_form($form->id, false, false, false, '', true, 1);

              ?>
              <script>
                jQuery(document).bind('gform_confirmation_loaded', function(event, formId){
                  //console.log(formId);
                  if(formId===<?php echo $form->id;  ?>){
                    //jQuery('#submitModal').modal('toggle');
                    jQuery('#registration-confirmation').modal('toggle');

                    dataLayer.push({
                      'event':'VirtualPageview',
                      'virtualPageURL':'/course/start-registration',
                      'virtualPageTitle' : 'Course - Start Registration'
                    });

                    <?php
                    /*
                    $course_code = get_field('course_code');
                    if($course_code=="CPC50210"){ ?>
                      ga('send', 'event', 'Start Registration', 'submit', 'Diploma – CPC50210');
                    <?php }elseif($course_code=="CPC50308"){ ?>
                      ga('send', 'event', 'Start Registration', 'submit', 'Diploma – CPC50308');
                    <?php }elseif($course_code=="CPC40110"){ ?>
                      ga('send', 'event', 'Start Registration', 'submit', 'Cert 4 - CPC40110');
                    <?php }elseif($course_code=="CPC40912"){ ?>
                      ga('send', 'event', 'Start Registration', 'submit', 'Cert 4 – CPC40912');
                    <?php } */?>
                  }
                });
                jQuery(document).ready(function() {
                  //jQuery('#submitModal').modal('toggle');
                });

              </script>

              <div class="modal fade registration-confirmation-modal" id="registration-confirmation">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <img src="<?php echo get_template_directory_uri(); ?>/img/modal-header.jpg" alt="" class="img-responsive" />
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                      <h3>Congratulations</h3>
                      <h4>You've taken the first step to becoming a legend.</h4>
                      <p>One of my mates from Builders Academy will be in touch soon.<br />Meanwhile, check your email for confirmation.</p>
                      <h4>Good luck!</h4>
                    </div>
                  </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
              </div><!-- /.modal -->

              <?php
            }

            //}

            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
    <script src="//app-sn03.marketo.com/js/forms2/js/forms2.min.js"></script>
	<form id="mktoForm_1746"></form>
	
    <script>
        const popupBtns = document.querySelectorAll('.popup-download');
        popupBtns.forEach( popupBtn => {
            popupBtn.addEventListener('click', (e) => {
              e.preventDefault();
 
              MktoForms2.loadForm("//app-sn03.marketo.com", "272-QDC-229", 1746, (form) => {
                  MktoForms2.lightbox(form).show();
				  form.onSuccess( (values, followUpUrl) => {
					  let brochure = popupBtn.getAttribute('href');

					  window.open(brochure);

					  return false;
				  });
				  
				  //close on clicked modal
				  const modalMask = document.querySelector('.mktoModalMask');
				  modalMask.addEventListener('click', function(){
					  document.querySelector('.mktoModalClose').click();
				  });
                });
				
            });
        });
      </script>
    <a class="mobile-cta single" href="#download-section">
          Download Course Brochure
        </a>
</div>
<?php endwhile; ?>

<?php
get_footer();