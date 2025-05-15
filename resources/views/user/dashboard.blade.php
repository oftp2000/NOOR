@extends('layouts.app')

@section('title', 'Tableau de bord Utilisateur')
@section('header-title', 'Bienvenue, {{ auth()->user()->name }}')

@section('content')
  {{-- Contenu spécifique à l’utilisateur --}}
  <p>Vous n’avez pas encore de notifications.</p>
@endsection
