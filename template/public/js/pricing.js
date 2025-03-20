function payNow(amountUSD) {
  fetch("https://api.exchangerate-api.com/v4/latest/USD") // Ambil kurs terbaru
      .then(response => response.json())
      .then(data => {
          let exchangeRate = data.rates.IDR; // Ambil nilai tukar USD ke IDR
          let amountIDR = Math.round(amountUSD * exchangeRate); // Konversi USD ke IDR

          // Kirim ke backend Laravel
          fetch("{{ route('payment.create') }}", {
              method: "POST",
              headers: {
                  "Content-Type": "application/json",
                  "X-CSRF-TOKEN": "{{ csrf_token() }}"
              },
              body: JSON.stringify({
                  amount: amountIDR
              })
          })
          .then(response => response.json())
          .then(data => {
              if (data.snap_token) {
                  window.snap.pay(data.snap_token, {
                      onSuccess: function(result) {
                          alert("Pembayaran berhasil!");
                          location.reload();
                      },
                      onPending: function(result) {
                          alert("Menunggu pembayaran...");
                      },
                      onError: function(result) {
                          alert("Pembayaran gagal!");
                      }
                  });
              } else {
                  alert("Gagal mendapatkan token pembayaran.");
              }
          })
          .catch(error => console.error('Error:', error));
      })
      .catch(error => {
          console.error('Error mengambil kurs:', error);
          alert("Gagal mengambil kurs USD ke IDR!");
      });
}