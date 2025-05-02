
<div class="space-y-8">
    {{-- Breadcrumbs --}}
    <x-layouts.breadcrumbs1 :items="$breadcrumbs" />

    {{-- Page Header --}}
    <x-layouts.page-header 
    title="<span class='italic text-[#f43f1a]'>Explore</span> the marbetsphere." 
/>

    {{-- Filter Bar --}}
    <x-layouts.filter-bar
        :view="$viewMode"
        :modes="['list', 'grid','row']"
        property="viewMode"
        search="search"
        resetMethod="resetProjectFilters"
    />
    {{-- List View --}}
    @if ($viewMode === 'list')
    <x-layouts.dynamic-list
    :columns="['Title', 'Status', 'Start', 'End', 'Created At', 'Open', 'Actions']"
    :rows="$projects->map(fn($p) => [
        $p->title,
         view('components.layouts.status-badge', ['status' => $p->status]), 
        \Carbon\Carbon::parse($p->start_date)->format('d.m.Y'),
        \Carbon\Carbon::parse($p->end_date)->format('d.m.Y'),
        \Carbon\Carbon::parse($p->created_at)->format('d.m.Y'),
        $p->open ? 'Yes' : 'No',
        'actions' => [
         'view' => ['route' => '', 'id' => null],
            'edit' => ['route' => '', 'id' => null],
            'delete' => ['route' => '', 'id' => null],
        ],
    ])"
/>
        {{-- Grid View --}}
        @elseif ($viewMode === 'grid')
    <div class="grid gap-4 grid-cols-1">
            @foreach ($projects as $project)
                <x-layouts.grid-card
                    :avatar="$project->client->avatar ?? null"
                    :title="$project->title"
                    :badges="[ 
                        ['text' => 'ONGOING'], 
                        ['text' => 'COMPLETED'] 
                    ]"
                    :meta="[ 
                        'Client' => $project->client->name ?? 'prakashsolutions', 
                        'Manager' => $project->manager->name ?? 'Event Manager' 
                    ]"
                    actionText="Go to Project →"
                   
                />
            @endforeach
        </div>
   @else($viewMode ==='row')

   @foreach ($projects as $project)
        <x-layouts.row-card
            :title="$project->title"
            :meta="[]" {{-- No meta fields like user count --}}
            :actionMethod="'toggleItem'"
            :actionParam="$project->id"
            :isOpen="$openedItem === (string) $project->id"
        >
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6">
                <x-layouts.card
                    :entity="$project"
                     :badges="['3 ONGOING', '2 COMPLETED']"
                    buttonLink="#"
                    buttonText="View Project →"
                />
            </div>
        </x-layouts.row-card>
    @endforeach
@endif
</div>
    
