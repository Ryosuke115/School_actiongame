<x-app-layout>
    <x-slot name="header">
      <h2 class="font-semibold text-xl textblack-800 leading-tight">
        <a href="/dashboard" style="color: #00BB00";>{{ __('進行ログ') }}</a>
        
        <a href="task/upcreate" style="color: #00BB00; padding-left: 30px">作品の新規作成・更新</a>
        <a style="color: black; padding-left: 30px">進行状況閲覧</a>
      </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <livewire:log-view></livewire:log-view>
            </div>
        </div>
    </div>
</x-app-layout>