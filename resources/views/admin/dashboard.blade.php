@extends('admin.layout')

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <h1 class="text-2xl font-bold mb-6">Dashboard</h1>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-blue-100 p-6 rounded-lg">
                    <h3 class="text-lg font-semibold text-blue-800">Total Pages</h3>
                    <p class="text-3xl font-bold text-blue-600 mt-2">{{ $pagesCount }}</p>
                </div>
                
                <div class="bg-green-100 p-6 rounded-lg">
                    <h3 class="text-lg font-semibold text-green-800">Total News</h3>
                    <p class="text-3xl font-bold text-green-600 mt-2">{{ $newsCount }}</p>
                </div>
                
                <div class="bg-purple-100 p-6 rounded-lg">
                    <h3 class="text-lg font-semibold text-purple-800">Languages</h3>
                    <p class="text-3xl font-bold text-purple-600 mt-2">2</p>
                    <p class="text-sm text-purple-600">EN, LV</p>
                </div>
            </div>
            
            <div class="mt-8">
                <h2 class="text-xl font-bold mb-4">Latest News</h2>
                <div class="bg-gray-50 rounded-lg p-4">
                    @if($latestNews->count() > 0)
                        <table class="min-w-full">
                            <thead>
                                <tr>
                                    <th class="text-left py-2">Title</th>
                                    <th class="text-left py-2">Status</th>
                                    <th class="text-left py-2">Created</th>
                                    <th class="text-left py-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($latestNews as $news)
                                    <tr class="border-t">
                                        <td class="py-2">{{ $news->title }}</td>
                                        <td class="py-2">
                                            @if($news->is_published)
                                                <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">Published</span>
                                            @else
                                                <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">Draft</span>
                                            @endif
                                        </td>
                                        <td class="py-2">{{ $news->created_at->format('M d, Y') }}</td>
                                        <td class="py-2">
                                            <a href="{{ route('admin.news.edit', $news) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-gray-500">No news yet.</p>
                    @endif
                </div>
            </div>
            
            <div class="mt-8 flex space-x-4">
                <a href="{{ route('admin.pages.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Manage Pages
                </a>
                <a href="{{ route('admin.news.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                    Create News
                </a>
                <a href="{{ route('admin.settings') }}" class="bg-purple-500 text-white px-4 py-2 rounded hover:bg-purple-600">
                    Site Settings
                </a>
            </div>
        </div>
    </div>
@endsection