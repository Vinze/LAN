<?php
if ($type == 'error') {
    $bgcolor = 'bg-rose-200';
    $textcolor = 'text-rose-800';
} elseif ($type == 'info') {
    $bgcolor = 'bg-sky-200';
    $textcolor = 'text-sky-800';
} elseif ($type == 'notice') {
    $bgcolor = 'bg-amber-200';
    $textcolor = 'text-amber-800';
} elseif ($type == 'success') {
    $bgcolor = 'bg-emerald-200';
    $textcolor = 'text-emerald-800';
}
?>
<div class="flex gap-4 mb-4 p-4 rounded items-center {{ $bgcolor }} {{ $textcolor }}">
    <div class="flex-0 ">
        @if ($type == 'error')
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-rose-500" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
        @elseif ($type == 'info')
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-sky-500" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
        </svg>
        @elseif ($type == 'notice')
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-amber-500" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
        @elseif ($type == 'success')
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-emerald-500" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
        @endif
    </div>
    <div class="flex-grow">
        {{ $slot }}
    </div>
</div>

