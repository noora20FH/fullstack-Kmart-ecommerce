<x-mainlayout title="Edit Profile">
    <div class="container py-5">
        
        <div class="row g-4 justify-content-center">
            
            <!-- Update Profile Information Card -->
            <div class="col-lg-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-light">
                        <h4 class="card-title mb-0">Informasi Profil</h4>
                        
                    </div>
                    <div class="card-body">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>

            <!-- Update Password Card -->
            <div class="col-lg-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-light">
                        <h4 class="card-title mb-0">Perbarui Kata Sandi</h4>
                        
                    </div>
                    <div class="card-body">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

            <!-- Delete Account Card -->
            <div class="col-lg-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-danger text-white">
                        <h4 class="card-title mb-0">Hapus Akun</h4>
                        
                    </div>
                    <div class="card-body">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</x-mainlayout>
