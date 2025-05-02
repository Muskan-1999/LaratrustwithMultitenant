<div class="space-y-8">
    {{-- Breadcrumbs --}}
    <x-layouts.breadcrumbs1 :items="$breadcrumbs" />

    {{-- Page Header --}}
    <x-layouts.page-header 
    title="Where <span class='italic text-[#f43f1a]'>clients</span> come to life."  
/>

    {{-- Filter Bar --}}
    <x-layouts.filter-bar
        :view="$viewMode"
        :modes="['list', 'grid','row']"
        property="viewMode"
        search="search"
        resetMethod="resetProjectFilters" />
    {{-- List View --}}
    @if ($viewMode === 'list')
    <x-layouts.dynamic-list
        :columns="['Name', 'Email', 'Domain', 'Actions']"
        :rows="$tenants->map(fn($tenant) => [
       $tenant->name,
      $tenant->email,
      $tenant->domain,
        'actions' => [
         'view' => ['route' => '', 'id' => null],
            'edit' => ['route' => '', 'id' => null],
            'delete' => ['route' => '', 'id' => null],
        ],
    ])" />
    {{-- Grid View --}}
    @elseif ($viewMode === 'grid')
    <div class="grid gap-4 grid-cols-1">
        @foreach ($tenants as $tenant)
        <x-layouts.grid-card
            :avatar="$tenant->client->avatar ?? null"
            :title="$tenant->name"
            :badges="[ 
                        ['text' => 'ONGOING'], 
                        ['text' => 'COMPLETED'] 
                    ]"
            :meta="[ 
                    'Role' => 'Event Manager', 
                    'Status' =>'Account Director' 
                    ]"
            actionText="Go to Tenant →" />
        @endforeach
    </div>
    @else($viewMode ==='row')
    @foreach ($tenants as $tenant)
    <x-layouts.row-card
        :avatar="$tenant->client->avatar ?? null"
        :title="$tenant->name"
        :actionMethod="'toggleItem'"
        :actionParam="$tenant->id"
        :isOpen="$openedItem === (string) $tenant->id">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6">
            <x-layouts.card
                :entity="$tenant"
                :badges="['3 ONGOING', '2 COMPLETED']"
                buttonLink="#"
                buttonText="View Tenant →" />
        </div>
    </x-layouts.row-card>
    @endforeach
    @endif
</div>