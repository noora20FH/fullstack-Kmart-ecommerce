const profileImage = document.getElementById('profile-image');
        const profilePhotoUpload = document.getElementById('profile-photo-upload');

        profilePhotoUpload.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (event) => {
                    profileImage.src = event.target.result;
                };
                reader.readAsDataURL(file);
            }
        });