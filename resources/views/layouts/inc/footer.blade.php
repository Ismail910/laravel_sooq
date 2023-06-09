<footer id="footer" class="mainBgColor text-center justify-content-center w-100 mb-0">
    <div class="container">
        <div class="row justify-content-center py-3" style="align-items: center;">
            <div class="col-12 col-md-4">
                <!-- Section: Social media -->
                <section class="text-center text-light mb-sm-2">
                    <!-- Facebook -->
                    <a class="btn text-white btn-floating m-1" style="background-color: #3b5998;"
                        href="{{ $settings->facebook_link }}" role="button"><i class="fab fa-facebook-f"></i></a>

                    <!-- Twitter -->
                    <a class="btn text-white btn-floating m-1" style="background-color: #55acee;"
                        href="{{ $settings->twitter_link }}" role="button"><i class="fab fa-twitter"></i></a>


                    <!-- Instagram -->
                    <a class="btn text-white btn-floating m-1" style="background-color: #ac2bac;"
                        href="{{ $settings->instagram_link }}" role="button"><i class="fab fa-instagram"></i></a>

                </section>
                <!-- Section: Social media -->
            </div>
            <div class="col-12 col-md-4">
                <!-- Copyright -->
                <div class="text-center text-light">
                    Copyright {{ date('Y') }} © {{ env('APP_NAME') }}
                </div>
                <!-- Copyright -->
            </div>
            <div class="col-12 col-md-4">
                <!-- Section: Social media -->
                <section class="text-center text-light mb-sm-2">
                    <!-- Facebook -->
                    <a class="text-light m-1" style="color: #fff !important" href="{{ route('contact') }}"
                        role="button">{{ __('lang.contact') }}</a>

                    <a class="text-light m-1" style="color: #fff !important" href="{{ route('about') }}"
                        role="button">{{ __('lang.about') }}</a>

                    <a class="text-light m-1" style="color: #fff !important" href="{{ route('privacy_policy') }}"
                        role="button">{{ __('lang.Privacy Policy') }}</a>

                </section>
                <!-- Section: Social media -->
            </div>
        </div>
    </div>

    <script>
        function setFooterPosition() {
            const screenHeight = window.innerHeight;
            const bodyHeight = document.body.clientHeight;
            const footerHeight = document.getElementById('footer').clientHeight;

            if (bodyHeight <= screenHeight) {
                document.getElementById('footer').style.position = 'fixed';
                document.getElementById('footer').style.bottom = '0';
            } else if (bodyHeight < screenHeight + footerHeight) {
                const margin = screenHeight - bodyHeight + footerHeight;
                document.getElementById('footer').style.marginTop = margin + 'px';
            } else {
                document.getElementById('footer').style.marginTop = '0';
            }
        }

        window.addEventListener('DOMContentLoaded', () => {
            setFooterPosition();
        });

        window.addEventListener('resize', () => {
            setFooterPosition();
        });
    </script>

</footer>
