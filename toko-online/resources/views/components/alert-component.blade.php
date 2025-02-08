@props(['type' => 'success', 'message' => ''])

@if(session($type))
    <div class="p-4 mb-4 text-sm rounded-lg 
        {{ $type === 'success' ? 'bg-green-100 text-green-800 border-green-400' : 'bg-red-100 text-red-800 border-red-400' }} border">
        {{ session($type) }}
    </div>
@endif
