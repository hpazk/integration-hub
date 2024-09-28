<x-filament::page>
    <style>
        table {
            table-layout: auto;
            /* Atur ke auto untuk lebar dinamis */
            width: 100%;
            /* Pastikan tabel mengisi kontainer */
        }

        th,
        td {
            overflow: hidden;
            /* Sembunyikan konten yang terlalu besar */
            text-overflow: ellipsis;
            /* Tambahkan elipsis untuk teks yang terlalu panjang */
            white-space: nowrap;
            /* Mencegah pemisahan teks ke baris baru */
        }
    </style>

    <h1 class="text-2xl font-bold mb-4">Data Terintegrasi</h1>

    @if (count($posts) > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 shadow-md rounded-lg">
                <thead class="bg-gray-100">
                    <tr>
                        @foreach (array_keys($posts[0]) as $key)
                            <th scope="col"
                                class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider border-b border-gray-200 whitespace-nowrap">
                                {{ ucfirst($key) }}
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($posts as $post)
                        <tr class="hover:bg-gray-100 transition duration-150 ease-in-out">
                            @foreach ($post as $value)
                                <td class="px-4 py-4 text-sm text-gray-900 border-b border-gray-200 whitespace-nowrap">
                                    {{ $value }}
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-gray-500">Data tidak tersedia</p>
    @endif
</x-filament::page>
