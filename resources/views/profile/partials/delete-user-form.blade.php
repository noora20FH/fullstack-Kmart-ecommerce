<section>
    <header>


        <p class="mt-2 text-muted">
            {{ __('Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Sebelum menghapus akun Anda, harap unduh data atau informasi apa pun yang ingin Anda simpan.') }}
        </p>
    </header>

    <button type="button" class="btn btn-danger mt-3" data-bs-toggle="modal" data-bs-target="#confirm-user-deletion-modal">
        {{ __('Hapus Akun') }}
    </button>

    <!-- Bootstrap Modal -->
    <div class="modal fade" id="confirm-user-deletion-modal" tabindex="-1" aria-labelledby="confirmUserDeletionLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{ route('profile.destroy', $user->id) }}">
                    @csrf
                    @method('delete')

                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmUserDeletionLabel">{{ __('Apakah Anda yakin ingin menghapus akun?') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mt-3">
                            <label for="password" class="form-label visually-hidden">{{ __('Kata Sandi') }}</label>
                            <input
                                id="password"
                                name="password"
                                type="password"
                                class="form-control"
                                placeholder="{{ __('Kata Sandi') }}"
                            />
                            @error('password', 'userDeletion')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            {{ __('Batal') }}
                        </button>
                        <button type="submit" class="btn btn-danger">
                            {{ __('Hapus Akun') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
