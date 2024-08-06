<x-layout>
    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-full">
            <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                <img class="w-8 h-8 mr-2" src="{{ Vite::asset('resources/images/logo.svg') }}" alt="logo">
                CheckQR
            </a>
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-center text-gray-900 md:text-2xl dark:text-white">
                        Create an account
                    </h1>
                    <form method="POST" class="space-y-4 md:space-y-6" action="/register">
                        @csrf
                        @method('POST')
    
                        <!-- Name Fields -->
                        <div class="flex flex-col space-y-4 md:flex-row md:space-x-4 md:space-y-0">
                            <div class="flex-1">
                                <input type="text" name="first_name" id="first_name" placeholder="First Name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required>
                                <x-form-error name="first_name"></x-form-error>
                            </div>
                            <div class="flex-1">
                                <input type="text" name="middle_name" id="middle_name" placeholder="Middle Name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <x-form-error name="middle_name"></x-form-error>
                            </div>
                            <div class="flex-1">
                                <input type="text" name="last_name" id="last_name" placeholder="Last Name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required>
                                <x-form-error name="last_name"></x-form-error>
                            </div>
                        </div>
    
                        <!-- Student ID -->
                        <div>
                            <input type="text" name="student_id" id="student_id" placeholder="Student ID"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                            <x-form-error name="student_id"></x-form-error>
                        </div>
    
                        <!-- Email -->
                        <div>
                            <input type="email" name="email" id="email" placeholder="Your Email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                            <x-form-error name="email"></x-form-error>
                        </div>
    
                        <!-- Street Address -->
                        <div>
                            <input type="text" name="street_address" id="street_address" placeholder="Street Address"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                            <x-form-error name="street_address"></x-form-error>
                        </div>
    
                        <!-- City and Barangay -->
                        <div class="flex flex-col space-y-4 md:flex-row md:space-x-4 md:space-y-0">
                            <div class="flex-1">
                                <select id="city" name="city"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    onchange="updateBarangays()" required>
                                    <option value="">Select a city</option>
                                    <option value="Boac">Boac</option>
                                    <option value="Buenavista">Buenavista</option>
                                    <option value="Gasan">Gasan</option>
                                    <option value="Mogpog">Mogpog</option>
                                    <option value="Santa Cruz">Santa Cruz</option>
                                    <option value="Torrijos">Torrijos</option>
                                </select>
                                <x-form-error name="city"></x-form-error>
                            </div>
                            <div class="flex-1">
                                <select id="barangay" name="barangay"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required>
                                    <option value="">Select a barangay</option>
                                </select>
                                <x-form-error name="barangay"></x-form-error>
                            </div>
                        </div>
    
                        <!-- Gender and Birthday -->
                        <div class="flex flex-col space-y-4 md:flex-row md:space-x-4 md:space-y-0">
                            <div class="flex-1">
                                <select id="gender" name="gender"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required>
                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                                <x-form-error name="gender"></x-form-error>
                            </div>
                            <div class="flex-1">
                                <input type="text" onfocus="(this.type='date')" name="birthday" id="birthday"
                                    placeholder="Birthday"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required>
                                <x-form-error name="birthday"></x-form-error>
                            </div>
                        </div>
    
                        <!-- Section, Major, Year -->
                        <div class="flex flex-col space-y-4 md:flex-row md:space-x-4 md:space-y-0">
                            <div class="flex-1">
                                <input type="text" name="section" id="section" placeholder="Section"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required>
                                <x-form-error name="section"></x-form-error>
                            </div>
                            <div class="flex-1">
                                <select id="major" name="major"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required>
                                    <option value="">Select Major</option>
                                    <option value="Software Development">Software Development</option>
                                    <option value="Networking and Data Security">Networking and Data Security</option>
                                    <option value="Graphics Design and Animation">Graphics Design and Animation</option>
                                </select>
                                <x-form-error name="major"></x-form-error>
                            </div>
                            <div class="flex-1">
                                <select id="year" name="year"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required>
                                    <option value="">Select Year</option>
                                    <option value="1st Year">1st Year</option>
                                    <option value="2nd Year">2nd Year</option>
                                    <option value="3rd Year">3rd Year</option>
                                    <option value="4th Year">4th Year</option>
                                </select>
                                <x-form-error name="year"></x-form-error>
                            </div>
                        </div>
    
                        <!-- Account Type (on a new line) -->
                        <div>
                            <select id="account_type" name="account_type"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                                <option value="">Select Account Type</option>
                                <option value="Student">Student</option>
                                <option value="Teacher">Teacher</option>
                                <option value="Administrator">Administrator</option>
                            </select>
                            <x-form-error name="account_type"></x-form-error>
                        </div>
    
                        <!-- Password Fields -->
                        <div class="flex flex-col space-y-4 md:flex-row md:space-x-4 md:space-y-0">
                            <div class="flex-1">
                                <input type="password" name="password" id="password" placeholder="Password"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required>
                                <x-form-error name="password"></x-form-error>
                            </div>
                            <div class="flex-1">
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    placeholder="Confirm Password"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required>
                                <x-form-error name="password_confirmation"></x-form-error>
                            </div>
                        </div>
    
                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            Create an account
                        </button>
    
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            Already have an account? <a href="{{ route('login') }}"
                                class="font-medium text-primary-600 hover:underline dark:text-primary-500">Login
                                here</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
    

    <!-- Background overlay -->
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm hidden z-40"></div>

    <!-- Terms and Conditions Modal -->
    <div id="terms-modal" tabindex="-1" aria-hidden="true"
        class="fixed inset-0 flex items-center justify-center z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto h-modal md:h-full">
        <div class="relative w-full max-w-2xl md:h-auto mx-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 border-b dark:border-gray-600">
                    <div class="text-center">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                            Terms and Conditions
                        </h2>
                    </div>
                    <button type="button"
                        class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                        data-modal-toggle="terms-modal">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M1 1l12 12M13 1L1 13" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6 max-h-[400px] overflow-y-auto">
                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        <strong>Privacy Policy</strong><br><br>
                        We are dedicated to ensuring the accuracy, confidentiality, and security of your personally
                        identifiable information ("Personal Information"). This Privacy Policy outlines how we collect,
                        use, and disclose Personal Information and aligns with the Canadian Standards Association's
                        Model Code for the Protection of Personal Information and Canada's Personal Information
                        Protection and Electronic Documents Act.<br><br>

                        <strong>1. Introduction</strong><br>
                        We are responsible for protecting the Personal Information under our control and have designated
                        individuals to ensure compliance with our Privacy Policy.<br><br>

                        <strong>2. Identifying Purposes</strong><br>
                        We collect, use, and disclose Personal Information to deliver the products or services you
                        request and to offer additional products and services that may interest you. We will identify
                        the purposes for collecting Personal Information before or at the time of collection. In some
                        cases, purposes may be clear, and consent may be implied, such as when providing your name,
                        address, and payment details during the order process.<br><br>

                        <strong>3. Consent</strong><br>
                        Your knowledge and consent are required for the collection, use, or disclosure of Personal
                        Information, except where otherwise required or permitted by law. Providing Personal Information
                        is always voluntary; however, withholding certain information may limit our ability to offer
                        products or services. We will not require consent for the collection, use, or disclosure of
                        information as a condition for supplying a product or service unless necessary to provide
                        it.<br><br>

                        <strong>4. Limiting Collection</strong><br>
                        We will collect only the Personal Information necessary for the identified purposes. With your
                        consent, we may gather Personal Information through various means, including in person, by
                        phone, or through mail, facsimile, or the Internet.<br><br>

                        <strong>5. Limiting Use, Disclosure, and Retention</strong><br>
                        Personal Information will only be used or disclosed for the purpose it was collected, unless you
                        consent otherwise or as required or permitted by law. Personal Information will be retained only
                        for as long as needed to fulfill the purpose for which it was collected or as required by
                        law.<br><br>

                        <strong>6. Accuracy</strong><br>
                        We will make reasonable efforts to ensure that Personal Information is accurate, complete, and
                        up-to-date as necessary for the purposes for which it is used. If you believe your Personal
                        Information is incorrect, you can contact us to update it.<br><br>

                        <strong>7. Safeguards</strong><br>
                        We are committed to protecting Personal Information with appropriate safeguards to prevent
                        unauthorized access, disclosure, or destruction. We employ physical, administrative, and
                        technological measures to protect your Personal Information.<br><br>

                        <strong>8. Openness</strong><br>
                        We will make our Privacy Policy readily available to you and provide information about our
                        practices and procedures for handling Personal Information. If you have questions or require
                        further information, you can contact us at any time.<br><br>

                        <strong>9. Access</strong><br>
                        You have the right to access your Personal Information held by us. We will respond to your
                        request within a reasonable time and provide access to your Personal Information, subject to any
                        legal restrictions.<br><br>

                        <strong>10. Compliance and Accountability</strong><br>
                        We are accountable for compliance with our Privacy Policy and will investigate and address any
                        complaints or inquiries regarding our handling of Personal Information. We will take appropriate
                        measures to address any issues and ensure adherence to our Privacy Policy.<br><br>

                        <strong>11. Changes to This Privacy Policy</strong><br>
                        We may update this Privacy Policy from time to time to reflect changes in our practices or legal
                        requirements. Any changes will be posted on our website, and we encourage you to review our
                        Privacy Policy periodically.<br><br>

                        <strong>12. Contact Us</strong><br>
                        If you have any questions, concerns, or complaints about our Privacy Policy or the handling of
                        your Personal Information, please contact us at:<br><br>

                        Marinduque State University, CICS<br>
                        Panfilo M. Manguera, Sr. Road, Tanza, Boac, Marinduque - Philippines<br>
                        president@mscmarinduque.edu.ph<br>
                        info.office@mscmarinduque.edu.ph<br>
                        Tel No. (042) 332-2028/2728<br><br>

                        By using our services or providing us with Personal Information, you agree to the terms outlined
                        in this Privacy Policy.
                    </p>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button type="button" id="agree-btn" data-modal-toggle="terms-modal"
                        class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">I
                        Agree</button>
                    <button type="button" data-modal-toggle="terms-modal"
                        class="text-gray-500 bg-white hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-white rounded-lg border border-gray-200 dark:border-gray-600 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium text-sm px-5 py-2.5 dark:bg-gray-800 dark:hover:bg-gray-700">Cancel</button>
                </div>
            </div>
        </div>
    </div>

</x-layout>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const openModalButton = document.getElementById('open-modal');
        const closeModalButtons = document.querySelectorAll('[data-modal-toggle="terms-modal"]');
        const modal = document.getElementById('terms-modal');
        const overlay = document.getElementById('overlay');
        const agreeButton = document.getElementById('agree-btn');
        const termsCheckbox = document.getElementById('terms');

        // Open modal
        openModalButton.addEventListener('click', () => {
            modal.classList.remove('hidden');
            overlay.classList.remove('hidden');
        });

        // Close modal
        closeModalButtons.forEach(button => {
            button.addEventListener('click', () => {
                modal.classList.add('hidden');
                overlay.classList.add('hidden');
            });
        });

        // Automatically check checkbox when user agrees
        agreeButton.addEventListener('click', () => {
            termsCheckbox.checked = true;
            modal.classList.add('hidden');
            overlay.classList.add('hidden');
        });
    });

    const barangays = {
        Boac: ["Agot", "Agumaymayan", "Amoingon", "Apitong", "Balagasan", "Bambang", "Bantad", "Bantay", "Bayuti",
            "Binunga", "Boi", "Boton", "Buliasnin", "Caganhao", "Canat", "Catubugan", "Daig", "Daypay", "Duyay",
            "Hinapulan", "Ihatub", "Isok I", "Isok II", "Laylay", "Lupac", "Mahinhin", "Mainit", "Malbog",
            "Maligaya", "Malusak", "Mangyan-Mababad", "Mangyan-Masi", "Mansiwat", "Market Site", "Maybo",
            "Murallon", "Ogbac", "Pawa", "Pili", "Poctoy", "Poras", "Puyog", "Sabong", "Santol", "Tabi",
            "Tagwak", "Tambunan", "Tampus", "Tanza", "Tugos", "Tumapon"
        ],
        Buenavista: ["Bagacay", "Bagtingon", "Bicas-Bicas", "Caigangan", "Daykitin", "Libas", "Malbog", "Sihi",
            "Timbo", "Tungib-Lipata", "Yook"
        ],
        Gasan: ["Antipolo", "Bachao Ibaba", "Bachao Ilaya", "Back-Bonbon", "Bacong-Bacong", "Bahi", "Bangbangalon",
            "Banot", "Banuyo", "Barangay I", "Barangay II", "Barangay III", "Bognuyan", "Cabugao", "Dawis",
            "Dili", "Libtangin", "Mahunig", "Mangiliol", "Masiga", "Matandang Gasan", "Pangi", "Pinggan",
            "Tabionan", "Tapuyan", "Tiguion"
        ],
        Mogpog: ["Anapog-Sibucao", "Argao", "Balanacan", "Banto", "Bintakay", "Bocboc", "Butansapa", "Candahon",
            "Capayang", "Danao", "Dulong Bayan", "Gitnang Bayan", "Guisian", "Hinadharan", "Hinanggayon", "Ino",
            "Janagdong", "Lamesa", "Laon", "Magapua", "Magtangob", "Malayak", "Malusak", "Mampaitan", "Mangyan",
            "Maniwaya", "Maphugo", "Maron", "Mendez", "Mogpog Poblacion", "Nangka I", "Nangka II", "Pili",
            "Puting Buhangin", "Sayao", "Silangan", "Sumangga", "Tarug"
        ],
        "Santa Cruz": ["Alobo", "Angas", "Aturan", "Baguidbirin", "Bagui", "Bagumbayan", "Balogo", "Balong-Balong",
            "Balugo", "Banahao", "Bangcuangan", "Banot", "Banuyo", "Barangay I", "Barangay II", "Barangay III",
            "Barangay IV", "Biga", "Botilao", "Buyabod", "Dating Bayan", "Devilla", "Dolores", "Haguimit",
            "Hupi", "Ipil", "Jolo", "Kaganhao", "Kalangkang", "Kamandugan", "Kasily", "Kilo-Kilo", "Labo",
            "Lamesa", "Landy", "Lapu-Lapu", "Ligas", "Lipa", "Lusok", "Mabini", "Mabuhay", "Mahinhin",
            "Makawayan", "Maniwaya", "Mansiwat", "Maranlig", "Mataas na Bayan", "Masalukot", "Masiga",
            "Matandaan", "Maybo", "Mendez", "Mogpog Poblacion", "Murallon", "Nangka I", "Nangka II", "Pag-asa",
            "Pagkakaisa", "Pagkamaka", "Pagpapakumbaba", "Pagsalang", "Pagsilang", "Pagsulong", "Pagsusuay",
            "Pamplona", "Panikihan", "Papatahan", "Parang", "Pasayanan", "Patag", "Pinagtung-Ulan", "Poctoy",
            "Puting Buhangin", "Rizal", "Salafao", "San Isidro", "San Pedro", "Santa Cruz", "Santa Fe",
            "Santa Maria", "Santo Niño", "Sayao", "Sibucao", "Silangan"
        ],
        Torrijos: ["Bangwayin", "Bayakbakin", "Bolo", "Bonliw", "Buangan", "Cabuyo", "Cagpo", "Dampulan",
            "Kay Duke", "Maranlig", "Marlangga", "Mongpong", "Malibago", "Makawayan", "Malinao", "Malibago",
            "Mariposa", "Mongpong", "Payanas", "Poctoy", "Sibuyao", "Suha", "Talawan", "Tiguion", "Yook"
        ]
    };


    function updateBarangays() {
        const citySelect = document.getElementById('city');
        const barangaySelect = document.getElementById('barangay');
        const selectedCity = citySelect.value;

        barangaySelect.innerHTML = '';

        if (selectedCity) {
            const cityBarangays = barangays[selectedCity];
            cityBarangays.forEach(barangay => {
                const option = document.createElement('option');
                option.value = barangay;
                option.textContent = barangay;
                barangaySelect.appendChild(option);
            });
        }
    }
</script>
