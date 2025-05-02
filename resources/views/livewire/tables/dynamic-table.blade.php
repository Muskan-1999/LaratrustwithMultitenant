<div class="overflow-x-auto bg-white shadow rounded-lg">
    <table class="table table-zebra w-full">
        <thead class="bg-base-200 text-base-content">
            <tr>
                @foreach ($columns as $column)
                    <th>{{ $column }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @forelse ($rows as $row)
                <tr>
                    @foreach ($row as $cell)
                        <td>{{ $cell }}</td>
                    @endforeach
                </tr>
            @empty
                <tr>
                    <td colspan="{{ count($columns) }}" class="text-center">No data available.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
