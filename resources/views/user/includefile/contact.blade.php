 <!-- CONTACT AREA START -->
<section class="contact_area section_padding" id="contact">
    <div class="container">
        <div class="row">
            <div class="section_title text-center">
                <h2 data-aos="fade-up">Contact Us</h2>
                <div class="em-bar-main">
                    <div class="em-bar em-bar-big" data-aos="fade-up"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12" data-aos="fade-right">
                <div class="contact_link">
                    <ul>
                        <li>
                            <span>phone</span>
                            <h6><a href="#"><i class="fab fa-whatsapp"></i> +216 21 184 010</a></h6>
                        </li>
                        <li>
                            <span>mail</span>
                            <h6><a href="#"><i class="far fa-envelope"></i> example99@gmail.com</a></h6>
                        </li>
                        <li>
                            <span>Address</span>
                            <h6><a href="#"><i class="far fa-building"></i>#400-7015 Macleod Trail South Calgary, Alberta T2H 2K6</a></h6>
                        </li>
                    </ul>
                </div>
                <div class="social_media">
                    <h6>follow us</h6>
                    <ul>
                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12" data-aos="fade-left">
                <div class="contact_form">
                    <form action="{{route('contact_email')}}" method="POST" accept-charset="utf-8">
                        {{csrf_field()}}
                    
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-12">
                                <div class="person_name form">
                                    <input type="text" class="form-control" placeholder="first name*" name="first_name" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-12">
                                <div class="person_name form">
                                    <input type="text" class="form-control" placeholder="last name*" name="last_name" required>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-12">
                                <div class="person_email form">
                                    <input type="email" class="form-control" placeholder="email*" name="email" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-12">
                                <div class="subject form">
                                    <input type="text" class="form-control" placeholder="subject" name="subject" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-12">
                                <div class="message form">
                                    <textarea name="message" class="form-control" spellcheck="false" placeholder="message*" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form_btn text-center" data-aos="fade-up">
                            <button type="submit" class="btn default_btn" value="send message"><i class="far fa-paper-plane"></i> send message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- CONTACT AREA END -->