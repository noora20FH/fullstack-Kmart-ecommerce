<a href="{{ route('products.show', $productId) }}" 
   class="btn" 
   style="background-color: #7B68EE; border-color: #7B68EE; color: white;"
   x-data
   x-on:click.prevent="
        fetch('{{ route('products.click', $productId) }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        }).then(response => {
            // Anda bisa menambahkan logika di sini setelah berhasil mencatat klik
            // Contoh: console.log('Klik berhasil dicatat!');
            window.location.href = '{{ route('products.show', $productId) }}';
        });
   "
>
    Lihat Detail
</a>