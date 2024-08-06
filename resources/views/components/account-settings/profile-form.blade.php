@props(['user', 'avatar'])
<div class="w-full px-4 py-8 mx-auto">
    <form action="/account-settings/{{ $user->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="image_url">Profile
                    Picture</label>
                <div class="flex items-center space-x-4">
                    <!-- Profile picture preview -->
                    <img id="profile-image-preview" class="w-10 h-10 rounded-full"
                        src="{{ $avatar->where('user_id', Auth::id())->pluck('image_url')->first() ? Storage::url($avatar->where('user_id', Auth::id())->pluck('image_url')->first()) : asset('/storage/avatars/default.png') }}"
                        alt="Rounded avatar">

                    <!-- Profile picture input -->
                    {{-- <input
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        aria-describedby="image_url_help" id="image_url" name="image_url" type="file" accept="image/*"> --}}
                        <input disabled
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-not-allowed bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        aria-describedby="image_url_help" id="image_url" name="image_url" type="file" accept="image/*">
                </div>
                <div class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="image_url_help">
                    A profile picture is useful to confirm you are logged into your account
                </div>
                <x-form-error name="image_url"></x-form-error>
            </div>



            <div>
                <label for="account_type" class="block mb-2 text-sm font-medium text-gray-900 cursor-not-allowed dark:text-white">Account
                    Type</label>
                <select disabled name="account_type" id="account_type"
                    class="bg-gray-50 border cursor-not-allowed border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    <option value="" disabled>Select account type</option>
                    <option @if ($user->account_type == 'Dean') selected @endif value="Dean">Dean
                    </option>
                    <option @if ($user->account_type == 'Faculty') selected @endif value="Faculty">Faculty
                    </option>
                    <option @if ($user->account_type == 'Staff') selected @endif value="Staff">Staff</option>
                    <option @if ($user->account_type == 'Student') selected @endif value="Student">Student</option>
                </select>
                <x-form-error name="account_type"></x-form-error>

            </div>

        </div>

        <div class="grid gap-4 mb-4 sm:grid-cols-3 sm:gap-6 sm:mb-5">
            <div>
                <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First
                    Name</label>
                <input type="text" name="first_name" id="first_name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    value="{{ $user->first_name }}" placeholder="Type first name">
                <x-form-error name="first_name"></x-form-error>
            </div>
            <div>
                <label for="middle_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Middle
                    Name</label>
                <input type="text" name="middle_name" id="middle_name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    value="{{ $user->middle_name }}" placeholder="Type middle name">
                <x-form-error name="middle_name"></x-form-error>
            </div>
            <div>
                <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last
                    Name</label>
                <input type="text" name="last_name" id="last_name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    value="{{ $user->last_name }}" placeholder="Type last name">
                <x-form-error name="last_name"></x-form-error>
            </div>
        </div>
        <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
            <div>
                <label for="birthday"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Birthday</label>
                <input type="text" id="birthday" name="birthday"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    value="{{ $user->birthday }}" placeholder="Enter your birthday">
                <x-form-error name="birthday"></x-form-error>
            </div>

            <div>
                <label for="gender"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gender</label>
                <select name="gender" id="gender"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    <option value="" disabled>Select gender</option>
                    <option @if ($user->gender == 'Male') selected @endif value="Male">Male</option>
                    <option @if ($user->gender == 'Female') selected @endif value="Female">Female</option>
                    <option @if ($user->gender == 'Other') selected @endif value="Other">Other</option>
                </select>
                <x-form-error name="gender"></x-form-error>
            </div>
        </div>
        <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 cursor-not-allowed dark:text-white">Email</label>
                <input disabled type="email" name="email" id="email"
                    class="bg-gray-50 cursor-not-allowed border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    value="{{ $user->email }}" placeholder="Type email address">
                <x-form-error name="email"></x-form-error>
            </div>
            <div>
                <label for="contact_num" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact
                    Number</label>
                <input type="tel" name="contact_num" id="contact_num"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    value="{{ $user->contact_num }}" placeholder="Type contact number">
                <x-form-error name="contact_num"></x-form-error>
            </div>
        </div>
        <div class="grid gap-4 mb-4 sm:grid-cols-3 sm:gap-6 sm:mb-5">
            @php
                $addressParts = explode(', ', $user->address);
                $street = $addressParts[0];
                $barangay = $addressParts[1];
                $city = $addressParts[2];
            @endphp
            <div>
                <label for="street_address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Street
                    Address</label>
                <input type="text" name="street_address" id="street_address"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    value="{{ $street }}" placeholder="Type street address">
                <x-form-error name="street_address"></x-form-error>
            </div>
            <div>
                <label for="city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">City</label>
                <select name="city" id="city" onchange="updateBarangays()"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    <option value="" disabled>Select city</option>
                    <option @if ($city == 'Boac') selected @endif value="Boac">Boac</option>
                    <option @if ($city == 'Buenavista') selected @endif value="Buenavista">Buenavista</option>
                    <option @if ($city == 'Gasan') selected @endif value="Gasan">Gasan</option>
                    <option @if ($city == 'Mogpog') selected @endif value="Mogpog">Mogpog</option>
                    <option @if ($city == 'Santa Cruz') selected @endif value="Santa Cruz">Santa Cruz</option>
                    <option @if ($city == 'Torrijos') selected @endif value="Torrijos">Torrijos</option>
                </select>
                <x-form-error name="city"></x-form-error>
            </div>
            <div>
                <label for="barangay"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Barangay</label>
                <select name="barangay" id="barangay"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    <option value="" disabled>Select barangay</option>
                    <option value="{{ $barangay }}" selected>{{ $barangay }}</option>
                </select>
                <x-form-error name="barangay"></x-form-error>
            </div>
        </div>

        <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
            <div>
                <label for="password"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                <input type="password" name="password" id="password"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Type new password" required>
                <x-form-error name="password"></x-form-error>
            </div>
            <div>
                <label for="password_confirmation"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Confirm new password" required>
                <x-form-error name="password_confirmation"></x-form-error>
            </div>
        </div>
        <button type="submit"
            class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-500 dark:hover:bg-primary-600 dark:focus:ring-primary-700">
            Submit
        </button>
    </form>
</div>
<script>
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

    // Start birthday placeholder
    document.getElementById('birthday').addEventListener('focus', function() {
        this.type = 'date';
    });

    document.getElementById('birthday').addEventListener('blur', function() {
        if (!this.value) {
            this.type = 'text';
        }
    });
    // End birthday placeholder

    // Start new avatar
    document.getElementById('image_url').addEventListener('change', function(event) {
        const fileInput = event.target;
        const file = fileInput.files[0];
        const preview = document.getElementById('profile-image-preview');

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result; // Update the image preview with the new file
            };

            reader.readAsDataURL(file);
        }
    });
    // End new avatar

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
