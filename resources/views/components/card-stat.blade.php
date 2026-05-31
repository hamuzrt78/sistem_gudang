@props(['title', 'value', 'icon', 'color' => 'blue'])

<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center hover:shadow-md transition-shadow duration-200">
    <div class="p-3 rounded-full bg-{{ $color }}-100 text-{{ $color }}-600 mr-4">
        {!! $icon !!}
    </div>
    <div>
        <p class="text-sm font-medium text-gray-500">{{ $title }}</p>
        <p class="text-2xl font-bold text-gray-800">{{ $value }}</p>
    </div>
</div>
