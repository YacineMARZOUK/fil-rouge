@extends('layouts.app')

@section('content')
<div class="bg-black min-h-screen py-12">
    <div class="container mx-auto px-4 max-w-4xl">
        <div class="bg-[#111111] rounded-lg shadow-lg border border-[#333333] p-8">
            <h1 class="text-4xl font-bold text-white mb-6 border-b border-[#CDFB47] pb-3">{{ $program->name }}</h1>

            <p class="text-gray-300 mb-8 bg-black/50 p-5 rounded-md border-l-4 border-[#CDFB47]">{{ $program->description }}</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-black p-5 rounded-lg border border-[#333333]">
                    <span class="text-gray-400">Difficulté : </span>
                    <span class="font-semibold text-[#CDFB47]">{{ ucfirst($program->difficulty) }}</span>
                </div>

                <div class="bg-black p-5 rounded-lg border border-[#333333]">
                    <span class="text-gray-400">Durée : </span>
                    <span class="font-semibold text-[#CDFB47]">{{ $program->duration }} semaines</span>
                </div>
            </div>

            
        </div>
        
        
    </div>
</div>
@endsection
