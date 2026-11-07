@extends('layouts.app')

@section('title', 'Chat dengan Petani')

@section('contentstyle', 'max-width:1000px')

@section('content')
<div class="chat-layout">

  <div class="chat-list">
    @foreach(config('dummy.farmers') as $f)
      @php
          $msgs = config('dummy.farmer_chats')[$f['id']] ?? [];
          $last = count($msgs) ? end($msgs)['t'] : 'Ketuk untuk mulai chat';
      @endphp
      <div class="chat-list-item {{ $loop->first ? 'active' : '' }}" data-thread="{{ $f['id'] }}">
        <div class="av">{{ $f['emoji'] }}</div>
        <div><div class="name">{{ $f['name'] }}</div><div class="msg">{{ $last }}</div></div>
      </div>
    @endforeach
  </div>

  <div id="threadPane">
    @foreach(config('dummy.farmers') as $f)
      @php $msgs = config('dummy.farmer_chats')[$f['id']] ?? []; @endphp
      <div class="thread" data-thread="{{ $f['id'] }}" style="{{ $loop->first ? '' : 'display:none' }}">
        <div class="thread-head">
          <div class="av" style="width:38px;height:38px;font-size:17px;border-radius:50%;background:var(--line);display:flex;align-items:center;justify-content:center">{{ $f['emoji'] }}</div>
          <div><b>{{ $f['name'] }}</b><div style="font-size:12px;color:var(--ink-soft)">{{ $f['loc'] }}</div></div>
        </div>
        <div class="thread-body">
          @forelse($msgs as $m)
            <div class="bubble {{ $m['me'] ? 'me' : 'them' }}">{{ $m['t'] }}</div>
          @empty
            <div class="empty"><div class="ic">💬</div>Mulai percakapan dengan {{ $f['name'] }}</div>
          @endforelse
        </div>
        <div class="thread-input">
          <input placeholder="Tulis pesan...">
          <button type="button">➤</button>
        </div>
      </div>
    @endforeach
  </div>

</div>
@endsection

@push('scripts')
<script>TaniSegar.initChat('f');</script>
@endpush