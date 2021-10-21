@extends('front.layouts.app')

@section('content')
    <!-- ====== Hero Start ====== -->
    <section class="ud-hero" id="home">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ud-hero-content wow fadeInUp" data-wow-delay=".2s">
                        <h1 class="ud-hero-title">
                            Your Life's Work, Powered By Our Life's Work
                        </h1>
                        <p class="ud-hero-desc">
                            Unique and powerful suite of software to run your entire business, brought to you by a company
                            with the long term vision to transform the way you work.
                        </p>
                        <ul class="ud-hero-buttons">
                            <li>
                                <a href="https://links.uideck.com/play-bootstrap-download" rel="nofollow noopener"
                                    target="_blank" class="ud-main-btn ud-white-btn">
                                    İndi Qeydiyyatdan Keç
                                </a>
                            </li>
                            <li>
                                <a href="https://github.com/uideck/play-bootstrap" rel="nofollow noopener" target="_blank"
                                    class="ud-main-btn ud-link-btn">
                                    Learn More <i class="lni lni-arrow-right"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ====== Hero End ====== -->

    <!-- ====== Contact Start ====== -->
    <section id="contact" class="ud-contact">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-8 col-lg-7">
                    <div class="ud-contact-content-wrapper">
                        <div class="ud-contact-title">
                            <span>CONTACT US</span>
                            <h2>
                                Let’s talk about <br />
                                Love to hear from you!
                            </h2>
                        </div>
                        <div class="ud-contact-info-wrapper">
                            <div class="ud-single-info">
                                <div class="ud-info-icon">
                                    <i class="lni lni-map-marker"></i>
                                </div>
                                <div class="ud-info-meta">
                                    <h5>Our Location</h5>
                                    <p>401 Broadway, 24th Floor, Orchard Cloud View, London</p>
                                </div>
                            </div>
                            <div class="ud-single-info">
                                <div class="ud-info-icon">
                                    <i class="lni lni-envelope"></i>
                                </div>
                                <div class="ud-info-meta">
                                    <h5>How Can We Help?</h5>
                                    <p>info@yourdomain.com</p>
                                    <p>contact@yourdomain.com</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="ud-contact-form-wrapper wow fadeInUp" data-wow-delay=".2s">
                        <h3 class="ud-contact-form-title">Send us a Message</h3>
                        <form class="ud-contact-form">
                            <div class="ud-form-group">
                                <label for="fullName">Full Name*</label>
                                <input type="text" name="fullName" placeholder="Adam Gelius" />
                            </div>
                            <div class="ud-form-group">
                                <label for="email">Email*</label>
                                <input type="email" name="email" placeholder="example@yourmail.com" />
                            </div>
                            <div class="ud-form-group">
                                <label for="phone">Phone*</label>
                                <input type="text" name="phone" placeholder="+885 1254 5211 552" />
                            </div>
                            <div class="ud-form-group">
                                <label for="message">Message*</label>
                                <textarea name="message" rows="1" placeholder="type your message here"></textarea>
                            </div>
                            <div class="ud-form-group mb-0">
                                <button type="submit" class="ud-main-btn">
                                    Send Message
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ====== Contact End ====== -->


@endsection

@section('script')

    <script>
        // ==== for menu scroll
        const pageLink = document.querySelectorAll(".ud-menu-scroll");

        pageLink.forEach((elem) => {
            elem.addEventListener("click", (e) => {
                e.preventDefault();
                document.querySelector(elem.getAttribute("href")).scrollIntoView({
                    behavior: "smooth",
                    offsetTop: 1 - 60,
                });
            });
        });

        // section menu active
        function onScroll(event) {
            const sections = document.querySelectorAll(".ud-menu-scroll");
            const scrollPos =
                window.pageYOffset ||
                document.documentElement.scrollTop ||
                document.body.scrollTop;

            for (let i = 0; i < sections.length; i++) {
                const currLink = sections[i];
                const val = currLink.getAttribute("href");
                const refElement = document.querySelector(val);
                const scrollTopMinus = scrollPos + 73;
                if (
                    refElement.offsetTop <= scrollTopMinus &&
                    refElement.offsetTop + refElement.offsetHeight > scrollTopMinus
                ) {
                    document
                        .querySelector(".ud-menu-scroll")
                        .classList.remove("active");
                    currLink.classList.add("active");
                } else {
                    currLink.classList.remove("active");
                }
            }
        }

        window.document.addEventListener("scroll", onScroll);
    </script>
@endsection
