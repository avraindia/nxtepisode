<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-6 col-4">
        </div>
        <div class="col-lg-3 col-md-6 col-4">
            <div class="footer-ul-header-text">
                <h6>NEED HELP</h6>
            </div>
            <div class="footer-ul">
                <ul>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">Track Order</a></li>
                    <li><a href="#">Returns & Refunds</a></li>
                    <li><a href="#">FAQs</a></li>
                    <li><a href="#">My Account</a></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-4">
            <div class="footer-ul-header-text">
                <h6>COMPANY</h6>
            </div>
            <div class="footer-ul">
                <ul>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Careers</a></li>
                    <li><a href="#">Community Initiatives</a></li>
                    <li><a href="#">Souled Armys</a></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-4">
            <div class="footer-ul-header-text">
                <h6>MORE INFO</h6>
            </div>
            <div class="footer-ul">
                <ul>
                    <li><a href="#">T&C</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Sitemap</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="copyright-footer-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="copy-right-text">
                    <p>©NEXT EPISODE - All Rights Reserved</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="footer-socil-media-section">
                    <a href="#">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                    <a href="#">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    <a href="#">
                        <i class="fa-brands fa-twitter"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- login and registaer form modal start-->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="logi-card">
                        <div class="login-card-register-card-header-text">
                            <h2>Login Form</h2>
                        </div>
                        <form id="submitLoginForm" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="new-address-form-input">
                                        <div class="login-form-input-icon">
                                            <i class="fa-solid fa-user"></i>
                                        </div>
                                        <input type="text" name="user_email" id="user_email" placeholder="Enter your username">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="new-address-form-input">
                                        <div class="login-form-input-icon">
                                            <i class="fa-solid fa-lock"></i>
                                        </div>
                                        <input type="password" name="psw" id="psw" placeholder="Enter your password">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-or-text">
                                        <h5>OR</h5>
                                    </div>
                                    <div class="google-login-btn">
                                        <a href="{{route('google-auth')}}" class="loginwithGooglebtn">
                                            <span><i class="fa-brands fa-google"></i> &nbsp;Sign in with Google</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-submit-btn">
                                        <input type="button" value="Login" class="loginbtn">
                                    </div>
                                </div>
                                <div class="login_resp"></div>
                            </div>
                        </form>
                        <div class="switch">Don't have an account? <a href="javascript:void(0);" onclick="switchCard()">Register
                                here</a></div>
                    </div>
                    <div class="register-card" style="display: none;">
                        <div class="login-card-register-card-header-text">
                            <h2>Register Form</h2>
                        </div>
                        <form id="submitRegisterForm" method="post">
                        @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="new-address-form-input">
                                        <div class="login-form-input-icon">
                                            <i class="fa-solid fa-user"></i>
                                        </div>
                                        <input type="text" id="full_name" name="full_name" placeholder="Enter your full name">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="new-address-form-input">
                                        <div class="login-form-input-icon">
                                            <i class="fa-solid fa-envelope"></i>
                                        </div>
                                        <input type="email" name="reg_email" id="reg_email" placeholder="Enter your email">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="new-address-form-input">
                                        <div class="login-form-input-icon">
                                            <i class="fa-solid fa-lock"></i>
                                        </div>
                                        <input type="password" id="new_password" name="new_password" placeholder="Enter your new password">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="new-address-form-input">
                                        <div class="login-form-input-icon">
                                            <i class="fa-solid fa-lock"></i>
                                        </div>
                                        <input type="password" name="psw_repeat" id="psw_repeat" placeholder="Enter Confirm Password">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="new-address-form-input">
                                        <div class="login-form-input-icon">
                                            <i class="fa-solid fa-phone"></i>
                                        </div>
                                        <input type="text" name="user_phone" id="user_phone" placeholder="Enter Phone">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <input class="form-check-input" type="radio" name="user_gender" id="inlineRadio1" value="m" checked> Male
                                    <input class="form-check-input" type="radio" name="user_gender" id="inlineRadio2" value="f"> Female
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-or-text">
                                        <h5>OR</h5>
                                    </div>
                                    <div class="google-login-btn">
                                        <a href="{{route('google-auth')}}" class="loginwithGooglebtn">
                                            <span><i class="fa-brands fa-google"></i> &nbsp;Sign in with Google</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-submit-btn">
                                        <input type="button" class="registerbtn" value="Register">
                                    </div>
                                </div>
                                <div class="register_resp"></div>
                            </div>
                        </form>
                        <div class="switch">Already have an account? <a href="javascript:void(0);" onclick="switchCard()">Login here</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- login and registaer form modal end-->