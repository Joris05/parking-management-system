    <div class="witr_swiper_area">
        <div class="swiper-container swiper_active">
            <div class="swiper-wrapper">
            <!-- 1 single slider -->
            <div class="swiper-slide d1 t1 m1 witr_swiper_height" style="background-image: url(<?php echo base_url(); ?>assets/customer/images/slider1.jpg);">
                <div class="witr_sw_text_area text-left">
                    <div class="witr_swiper_content">
                        <h2>Best Space Car </h2>
                        <h3>Parking Area </h3>
                        <p>If you're opting for Long Stay, the car park is just 10 minutes away
                        by bus and shuttles run every 10-15 minutes.
                        </p>
                    </div>
                </div>
            </div>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-scrollbar"></div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>

    <div class="rekin_service_area">
          <div class="container">
             <div class="row">
                <div class="col-lg-12">
                   <div class="witr_section_title">
                      <div class="witr_section_title_inner text-center">
                         <h3>Our Parking Space Available </h3>
                      </div>
                   </div>
                </div>
                
                <?php 
                    foreach ($vehicle_datas as $k => $v) {
                ?>
                <div class="col-lg-4 col-md-6">
                   <div class="em-service all_color_service filter_contrast_brightness text-center">
                      <div class="em_service_content">
                         <div class="em_single_service_text">
                            <div class="service_top_text">
                                <div class="em-service-icon all_icon_color">	
                                  <img src="<?php echo base_url(); ?>assets/customer/images/wheel.png" alt="image" />
                               </div>
                               <div class="em-service-title">
                                  <h3><a href="#"><?php echo $v['vehicle']['name']; ?> </a></h3>
                               </div>
                            </div>
                            <div class="service-btn">
                               <a href="#"><?php echo $v['slots']['total_available']; ?></a>
                            </div>
                         </div>
                      </div>
                   </div>
                </div>
                <?php } ?>
             </div>
          </div>
       </div>