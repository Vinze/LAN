<?php
if ($type == 'error') {
    $classlist = 'bg-red-100 text-red-700';
    $icon = '×';
} elseif ($type == 'info') {
    $classlist = 'bg-blue-100 text-blue-700';
    $icon = 'i';
} elseif ($type == 'notice') {
    $classlist = 'bg-yellow-100 text-yellow-700';
    $icon = '!';
} elseif ($type == 'success') {
    $classlist = 'bg-green-100 text-green-700';
    $icon = '✓';
}
?>
<div class="flex gap-4 mb-4 p-4 rounded items-center {{ $classlist }}">
    <div class="flex-0 text-4xl font-bold">
        {{ $icon }}
    </div>
    <div class="flex-grow">
        {{ $slot }}
    </div>
</div>