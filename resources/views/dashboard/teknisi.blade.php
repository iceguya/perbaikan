<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Teknisi
        </h2>
    </x-slot>

    <main class="flex-grow max-w-[1200px] mx-auto px-6 py-12 space-y-12">
        <section class="text-center max-w-3xl mx-auto">
            <h1 class="text-5xl font-extrabold text-gray-900 leading-tight mb-4 select-none">
                Dashboard Teknisi
            </h1>
            <p class="text-lg text-gray-500 font-medium select-none" aria-live="polite">
                Anda login sebagai <strong class="text-gray-900">Teknisi</strong>.
            </p>
        </section>
        
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        <section aria-labelledby="orders-heading">
            <h2 id="orders-heading" class="text-3xl font-semibold text-gray-900 mb-8 select-none">
                Daftar Pekerjaan Anda
            </h2>

            <div id="orders-list" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10" role="list">
                <p class="text-gray-500 text-center col-span-full">Memuat pesanan...</p>
            </div>

            <p id="empty-message" class="mt-16 text-center text-gray-400 text-lg select-none hidden">
                Belum ada pekerjaan yang ditugaskan untuk Anda.
            </p>
        </section>
    </main>

    <script>
        const statusInfo = {
            "assigned": { label: "Baru", bg: "bg-yellow-100", text: "text-yellow-700", ring: "ring-yellow-200" },
            "in-process": { label: "Diproses", bg: "bg-blue-100", text: "text-blue-700", ring: "ring-blue-200" },
            "completed": { label: "Selesai", bg: "bg-green-100", text: "text-green-700", ring: "ring-green-200" },
        };

        const ordersList = document.getElementById("orders-list");
        const emptyMessage = document.getElementById("empty-message");

        async function fetchTechnicianOrders() {
            try {
                const response = await fetch('{{ route('api.teknisi.orders') }}', {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    },
                });

                if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                return await response.json();
            } catch (error) {
                console.error('Error fetching technician orders:', error);
                ordersList.innerHTML = `<p class="text-red-500 text-center col-span-full">Gagal memuat pesanan: ${error.message}</p>`;
                emptyMessage.classList.add("hidden");
                return null;
            }
        }

        function renderOrders(ordersData) {
            ordersList.innerHTML = "";
            if (!ordersData || ordersData.length === 0) {
                emptyMessage.classList.remove("hidden");
                return;
            }
            emptyMessage.classList.add("hidden");

            ordersData.forEach((order) => {
                const statusClass = statusInfo[order.status] || statusInfo['assigned'];
                const card = document.createElement("article");
                card.setAttribute("tabindex", "0");
                card.className = "shadow-light rounded-3xl bg-white p-8 flex flex-col justify-between focus:outline-none focus:ring-2 focus:ring-blue-600";
                
                const orderIdNumber = order.id.replace('REQ-', '');
                
                // --- PERUBAHAN UTAMA DI SINI ---
                // Membuat URL dengan placeholder, lalu menggantinya dengan ID asli
                const actionUrl = `{{ route('teknisi.work-orders.complete', ['serviceRequest' => 'PLACEHOLDER']) }}`.replace('PLACEHOLDER', orderIdNumber);

                card.innerHTML = `
                    <header class="mb-5">
                        <h3 class="text-2xl font-extrabold text-gray-900 select-text mb-1" title="ID Pesanan ${order.id}">${order.id}</h3>
                        <p class="text-gray-600 line-clamp-2 select-text" title="${order.description}">${order.description}</p>
                        ${order.details ? `<p class="text-sm text-gray-500 mt-1">${order.details}</p>` : ''}
                    </header>
                    <section class="mb-6">
                        <span class="inline-block px-4 py-1 rounded-full font-semibold uppercase text-sm ring-1 ${statusClass.text} ${statusClass.bg} ${statusClass.ring}">
                            ${statusClass.label}
                        </span>
                    </section>
                    <footer class="mt-auto flex gap-4 flex-wrap">
                        ${
                            (order.status === 'in-process' || order.status === 'assigned')
                                ? `<form action="${actionUrl}" method="POST" class="w-full">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="_method" value="PATCH">
                                        <button type="submit" class="w-full btn-selesai flex-grow bg-green-600 text-white rounded-xl py-3 text-lg font-semibold shadow hover:bg-green-700" aria-label="Tandai pesanan ${order.id} selesai">Selesai</button>
                                   </form>`
                                : `<button disabled class="opacity-50 cursor-not-allowed w-full flex-grow bg-gray-200 rounded-xl py-3 text-lg font-semibold text-gray-500">Selesai</button>`
                        }
                    </footer>
                `;
                ordersList.appendChild(card);
            });
        }

        document.addEventListener("DOMContentLoaded", async () => {
            const initialOrders = await fetchTechnicianOrders();
            if (initialOrders) {
                renderOrders(initialOrders);
            }
        });
    </script>
</x-app-layout>