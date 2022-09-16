 <!--choose-location-->
 <div class="choose-location-modal">
            <!-- Modal -->
            <div class="modal fade" id="chooselocation" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="change-location-box">
                                <button class="close-button" type="button" data-bs-dismiss="modal" aria-label="Close">
                                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g opacity="0.3" clip-path="url(#clip0_1346_10214)">
                                            <path d="M12.5029 24.999C5.67561 25.0317 0.0217524 19.4155 -0.000294086 12.5851C-0.00947247 10.9372 0.306788 9.30373 0.93033 7.77841C1.55387 6.25309 2.47242 4.86596 3.63326 3.69663C4.79411 2.52729 6.17439 1.59877 7.69489 0.964358C9.21539 0.329944 10.8462 0.00212378 12.4937 -0.000285882C19.321 -0.0394106 24.9777 5.59882 24.9997 12.472C25.0218 19.3714 19.4404 24.9663 12.5029 24.999ZM12.5029 10.8807C12.4218 10.8038 12.35 10.7384 12.2824 10.6729C11.2977 9.68842 10.313 8.70343 9.32822 7.71796C9.02526 7.4135 8.66824 7.26767 8.24225 7.36228C8.03991 7.3989 7.85219 7.49242 7.70105 7.63187C7.54992 7.77133 7.44162 7.95097 7.38884 8.14975C7.25371 8.60218 7.38883 8.98845 7.71171 9.31567C8.70167 10.3078 9.69258 11.2994 10.6844 12.2906C10.7506 12.3574 10.8146 12.4272 10.9291 12.546C10.8382 12.6017 10.7516 12.6642 10.6702 12.733C9.69495 13.7033 8.723 14.6755 7.75438 15.6496C7.36252 16.043 7.26438 16.5345 7.47702 16.987C7.81981 17.7182 8.74647 17.8626 9.34813 17.2672C10.331 16.2927 11.306 15.3103 12.2853 14.3322C12.3528 14.2646 12.424 14.2006 12.5043 14.1245C12.5797 14.1956 12.6466 14.2504 12.707 14.3115L14.4949 16.0999C14.9088 16.5139 15.3177 16.9336 15.7395 17.3398C16.0574 17.6464 16.4407 17.7488 16.8681 17.6158C17.0671 17.5614 17.2464 17.4512 17.385 17.2984C17.5235 17.1455 17.6156 16.9563 17.6504 16.7529C17.7414 16.314 17.575 15.9576 17.2649 15.6496C16.2845 14.6736 15.3057 13.695 14.3285 12.7138C14.2617 12.6477 14.1984 12.5773 14.0995 12.4734C14.1955 12.3951 14.2773 12.3404 14.3456 12.2721C15.3192 11.3011 16.2892 10.3258 17.2614 9.35551C17.5715 9.04749 17.7386 8.6911 17.6476 8.2529C17.6132 8.04926 17.5213 7.85971 17.3827 7.70667C17.244 7.55363 17.0645 7.4435 16.8653 7.38931C16.4158 7.24704 16.0247 7.37295 15.6968 7.70018C14.7045 8.69039 13.7133 9.68155 12.7234 10.6737C12.653 10.7405 12.5818 10.8045 12.5001 10.8807H12.5029Z" fill="#4E4E4E"/>
                                        </g>
                                        <defs>
                                        <clipPath id="clip0_1346_10214"><rect width="25" height="25" fill="white"/></clipPath>
                                        </defs>
                                    </svg>
                                </button>
                                <h5>Choose Restaurant Location</h5>
                                <div class="choose-location-search">
                                    <input type="text" placeholder="Enter zipcode & search restaurants">
                                    <img src="{{ asset('assets/pos/images/choose-search.svg')}}" alt="icon" />
                                </div>
                                <div class="change-location-option">
                                    <div class="form-check">
                                        <label class="form-check-label" for="flexRadioDefault11">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault11" checked>
                                        <span>959 Homestead Street Eastlake, NYC</span> 
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label" for="flexRadioDefault22">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault22">
                                            <span>1512 Town Center Dr, Pflugerville, Texas, 78660</span> 
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label" for="flexRadioDefault33">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault33">
                                            <span>599 New street, Washington, USA</span> 
                                        </label>
                                    </div>
                                    <div class="form-check mb-0">
                                        <label class="form-check-label" for="flexRadioDefault44">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault44" >
                                            <span>2313 Soldier Springs Rd, Laramie, Wyoming, USA</span> 
                                        </label>
                                    </div>
                                    <div class="submit-btn text-center">
                                        <button class="comman-btn">CONTINUE</button>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('assets/pos/js/popper.min.js')}}"></script>
        <script src="{{ asset('assets/pos/js/bootstrap.min.js')}}"></script>
		<script src="{{ asset('assets/pos/js/jquery.min.js')}}"></script>
        <!-- <script src="ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>  -->
		<script src="{{ asset('assets/pos/js/custom.js')}}"></script>
        <script src="{{ asset('assets/pos/js/jquery.dataTables.min.js')}}"></script>
		<script src="{{ asset('assets/pos/js/dataTables.bootstrap5.min.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <script>$('#list_student').DataTable({});</script>

    </body>

    
</html>