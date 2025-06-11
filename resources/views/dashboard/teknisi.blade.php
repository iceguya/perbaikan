<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Teknisi
        </h2>
    </x-slot>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard Teknisi</title>
  <link
    href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css"
    rel="stylesheet"
  />
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
      -webkit-box-orient: vertical;
      overflow: hidden;
    }
  </style>
</head>
<body class="bg-white text-gray-700 font-sans min-h-screen flex flex-col">

  <!-- Sticky header nav -->
  <header
    class="sticky top-0 bg-white border-b border-gray-200 z-30"
    role="banner"
  >
    <nav
      class="max-w-[1200px] mx-auto flex items-center justify-between px-6 py-4"
      aria-label="Primary Navigation"
    >
      <a
        href="#"
        class="text-2xl font-extrabold text-gray-900 select-none"
        aria-label="Homepage"
      >
        LogoTeknisi
      </a>
      <div>
        <button
          type="button"
          class="text-gray-700 font-semibold px-4 py-2 rounded-md hover:bg-gray-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 transition"
          aria-label="Logout"
        >
          Logout
        </button>
      </div>
    </nav>
  </header>

  <main class="flex-grow max-w-[1200px] mx-auto px-6 py-16 space-y-16">
    <!-- Hero Title Section -->
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

    <!-- Orders Section -->
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
        <!-- Order cards inserted here by JS -->
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
    /**
     * Order data example with 3 states:
     *   'pending' (waiting),
     *   'in-process' (diproses),
     *   'completed' (selesai)
     */
    const orders = [
      {
        id: "ORD001",
        description: "Perbaikan AC di lantai 2 kantor pusat",
        status: "pending",
      },
      {
        id: "ORD002",
        description: "Maintenance rutin mesin produksi",
        status: "pending",
      },
      {
        id: "ORD003",
        description: "Instalasi jaringan baru di gudang",
        status: "in-process",
      },
    ];

    // Status label + styling configuration
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

    function renderOrders() {
      ordersList.innerHTML = "";
      if (orders.length === 0) {
        emptyMessage.classList.remove("hidden");
        return;
      }
      emptyMessage.classList.add("hidden");

      orders.forEach((order) => {
        const { id, description, status } = order;
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
          </header>
          <section class="mb-6">
            <span class="inline-block px-4 py-1 rounded-full font-semibold uppercase text-sm ring-1 ${statusClass.text} ${statusClass.bg} ${statusClass.ring}" aria-label="Status pesanan: ${statusClass.label}">
              ${statusClass.label}
            </span>
          </section>
          <footer class="mt-auto flex gap-4 flex-wrap">
            ${
              status === "pending"
                ? <button class="btn-proses flex-grow bg-blue-600 text-white rounded-xl py-3 text-lg font-semibold shadow hover:bg-blue-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600" data-id="${id}" aria-label="Mulai proses pesanan ${id}">Proses</button>
                : ""
            }
            ${
              status === "in-process"
                ? <button class="btn-selesai flex-grow bg-green-600 text-white rounded-xl py-3 text-lg font-semibold shadow hover:bg-green-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600" data-id="${id}" aria-label="Tandai pesanan ${id} selesai">Selesai</button>
                : ""
            }
            ${
              status === "completed"
                ? <button disabled class="opacity-50 cursor-not-allowed flex-grow bg-gray-200 rounded-xl py-3 text-lg font-semibold text-gray-500" aria-label="Pesanan ${id} sudah selesai">Selesai</button>
                : ""
            }
          </footer>
        `;

        ordersList.appendChild(card);
      });

      bindActionButtons();
    }

    function bindActionButtons() {
      const prosesButtons = document.querySelectorAll(".btn-proses");
      prosesButtons.forEach((btn) => {
        btn.addEventListener("click", () => {
          const id = btn.getAttribute("data-id");
          updateOrderStatus(id, "in-process");
        });
      });

      const selesaiButtons = document.querySelectorAll(".btn-selesai");
      selesaiButtons.forEach((btn) => {
        btn.addEventListener("click", () => {
          const id = btn.getAttribute("data-id");
          updateOrderStatus(id, "completed");
        });
      });
    }

    function updateOrderStatus(id, newStatus) {
      const order = orders.find((o) => o.id === id);
      if (order) {
        order.status = newStatus;
        renderOrders();
      }
    }

    renderOrders();
  </script>
</body>
</html>
</x-app-layout>