<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Teknisi
        </h2>
    </x-slot>

    {{-- <html lang="id">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet" />
        <style>
            /* Custom shadows and smooth scaling for cards and buttons */
            .shadow-light {
                box-shadow: 0 2px 8px rgb(0 0 0 / 0.07);
            }
            .scale-hover:hover {
                transform: scale(1.04);
                transition: transform 0.3s ease;
            }
            .scale-hover:focus-visible {
                outline: 2px solid #2563eb;
                outline-offset: 2px;
                transform: scale(1.04);
            }
            /* Text truncation multi-line clamp */
            .line-clamp-2 {
                display: -webkit-box;
                -webkit-line-clamp: 2;
                line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }
        </style>
    </head>
    <body> --}}

    <main class="flex-grow max-w-[1200px] mx-auto px-6 py-16 space-y-16">
        <section class="text-center max-w-3xl mx-auto">
            <h1
                class="text-5xl font-extrabold text-gray-900 leading-tight mb-4 select-none"
            >
                Dashboard Teknisi
            </h1>
            <p
                class="text-lg text-gray-500 font-medium select-none"
                aria-live="polite"
            >
                Anda login sebagai <strong class="text-gray-900">Teknisi</strong>.
            </p>
        </section>

        <section aria-labelledby="orders-heading">
            <h2
                id="orders-heading"
                class="text-3xl font-semibold text-gray-900 mb-8 select-none"
            >
                Daftar Pesanan Anda
            </h2>

            <div
                id="orders-list"
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10"
                role="list"
            >
                <p class="text-gray-500 text-center col-span-full">Memuat pesanan...</p>
            </div>

            <p
                id="empty-message"
                class="mt-16 text-center text-gray-400 text-lg select-none hidden"
            >
                Belum ada pesanan yang diterima.
            </p>
        </section>
    </main>

    <script>
        // Status label + styling configuration (TETAP SAMA)
        const statusInfo = {
            "pending": {
                label: "Menunggu",
                bg: "bg-gray-100",
                text: "text-gray-500",
                ring: "ring-gray-200",
            },
            "in-process": {
                label: "Diproses",
                bg: "bg-blue-100",
                text: "text-blue-700",
                ring: "ring-blue-200",
            },
            "completed": {
                label: "Selesai",
                bg: "bg-green-100",
                text: "text-green-700",
                ring: "ring-green-200",
            },
        };

        const ordersList = document.getElementById("orders-list");
        const emptyMessage = document.getElementById("empty-message");

        // Fungsi untuk mengambil data dari API
        async function fetchTechnicianOrders() {
            try {
                // Mengambil token CSRF dari meta tag Laravel
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                const response = await fetch("{{ route('api.teknisi.orders') }}", {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest', // Penting untuk Laravel menerima ini sebagai AJAX
                        'X-CSRF-TOKEN': csrfToken, // Jika Anda menggunakan middleware VerifyCsrfToken
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                return await response.json();
            } catch (error) {
                console.error('Error fetching technician orders:', error);
                ordersList.innerHTML = `<p class="text-red-500 text-center col-span-full">Gagal memuat pesanan: ${error.message}</p>`;
                emptyMessage.classList.add("hidden"); // Sembunyikan pesan kosong jika ada error
                return null;
            }
        }

        // Fungsi untuk merender pesanan (diperbarui untuk menerima array pesanan)
        function renderOrders(ordersData) {
            ordersList.innerHTML = ""; // Bersihkan placeholder "Memuat..."
            if (!ordersData || ordersData.length === 0) {
                emptyMessage.classList.remove("hidden");
                return;
            }
            emptyMessage.classList.add("hidden");

            ordersData.forEach((order) => {
                const { id, description, status, details } = order; // Tambahkan 'details'
                const statusClass = statusInfo[status];
                const card = document.createElement("article");
                card.setAttribute("tabindex", "0");
                card.setAttribute("role", "listitem");
                card.className =
                    "shadow-light rounded-3xl bg-white p-8 flex flex-col justify-between scale-hover focus:outline-none focus:ring-2 focus:ring-blue-600";

                card.innerHTML = `
                    <header class="mb-5">
                        <h3 class="text-2xl font-extrabold text-gray-900 select-text mb-1" title="ID Pesanan ${id}">${id}</h3>
                        <p class="text-gray-600 line-clamp-2 select-text" title="${description}">${description}</p>
                        ${details ? `<p class="text-sm text-gray-500 mt-1">${details}</p>` : ''}
                    </header>
                    <section class="mb-6">
                        <span class="inline-block px-4 py-1 rounded-full font-semibold uppercase text-sm ring-1 ${statusClass.text} ${statusClass.bg} ${statusClass.ring}" aria-label="Status pesanan: ${statusClass.label}">
                            ${statusClass.label}
                        </span>
                    </section>
                    <footer class="mt-auto flex gap-4 flex-wrap">
                        ${
                            status === "pending"
                                ? `<button class="btn-proses flex-grow bg-blue-600 text-white rounded-xl py-3 text-lg font-semibold shadow hover:bg-blue-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600" data-id="${id}" aria-label="Mulai proses pesanan ${id}">Proses</button>`
                                : ""
                        }
                        ${
                            status === "in-process"
                                ? `<button class="btn-selesai flex-grow bg-green-600 text-white rounded-xl py-3 text-lg font-semibold shadow hover:bg-green-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600" data-id="${id}" aria-label="Tandai pesanan ${id} selesai">Selesai</button>`
                                : ""
                        }
                        ${
                            status === "completed"
                                ? `<button disabled class="opacity-50 cursor-not-allowed flex-grow bg-gray-200 rounded-xl py-3 text-lg font-semibold text-gray-500" aria-label="Pesanan ${id} sudah selesai">Selesai</button>`
                                : ""
                        }
                    </footer>
                `;
                ordersList.appendChild(card);
            });

            bindActionButtons(); // Bind ulang event listener setelah merender
        }

        // Fungsi untuk mengupdate status pesanan (akan memanggil API UPDATE di masa depan)
        async function updateOrderStatus(orderId, newStatus) {
            // Placeholder: Di sini Anda akan memanggil API Laravel untuk mengupdate status order di database
            // Misalnya: await fetch(`/teknisi/orders/${orderId}/update-status`, { method: 'POST', body: JSON.stringify({ status: newStatus }) });

            alert(`Pesanan ${orderId} diubah ke status: ${newStatus}. (Ini hanya simulasi, belum terhubung ke backend untuk update status)`);

            // Setelah update berhasil di backend, refresh daftar pesanan
            const updatedOrders = await fetchTechnicianOrders();
            renderOrders(updatedOrders);
        }

        // Panggil saat DOM selesai dimuat
        document.addEventListener("DOMContentLoaded", async () => {
            const initialOrders = await fetchTechnicianOrders();
            if (initialOrders) {
                renderOrders(initialOrders);
            }
        });

        // Event listener untuk tombol aksi
        function bindActionButtons() {
            const prosesButtons = document.querySelectorAll(".btn-proses");
            prosesButtons.forEach((btn) => {
                btn.removeEventListener('click', handleProsesClick); // Hapus listener lama jika ada
                btn.addEventListener("click", handleProsesClick);
            });

            const selesaiButtons = document.querySelectorAll(".btn-selesai");
            selesaiButtons.forEach((btn) => {
                btn.removeEventListener('click', handleSelesaiClick); // Hapus listener lama jika ada
                btn.addEventListener("click", handleSelesaiClick);
            });
        }

        function handleProsesClick(event) {
            const id = event.currentTarget.getAttribute("data-id");
            updateOrderStatus(id, "in-process");
        }

        function handleSelesaiClick(event) {
            const id = event.currentTarget.getAttribute("data-id");
            updateOrderStatus(id, "completed");
        }
    </script>
    {{-- </body>
    </html> --}}
</x-app-layout>