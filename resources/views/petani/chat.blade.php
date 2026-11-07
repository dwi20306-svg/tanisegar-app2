@extends('layouts.app')

@section('title', 'Chat dengan Pembeli')

@section('contentstyle', 'max-width:1000px')

@section('content')
<div class="chat-layout">

  <div class="chat-list">
    @forelse(config('dummy.buyer_chats') as $id => $b)
      @php $last = count($b['msgs']) ? end($b['msgs'])['t'] : 'Belum ada pesan'; @endphp
      <div class="chat-list-item {{ $loop->first ? 'active' : '' }}" data-thread="{{ $id }}">
        <div class="av">{{ $b['emoji'] }}</div>
        <div><div class="name">{{ $b['name'] }}</div><div class="msg">{{ $last }}</div></div>
      </div>
    @empty
      <div class="empty" style="padding:30px 16px"><div class="ic">💬</div>Belum ada percakapan</div>
    @endforelse
  </div>

  <div id="threadPane">
    @forelse(config('dummy.buyer_chats') as $id => $b)
      <div class="thread" data-thread="{{ $id }}" style="{{ $loop->first ? '' : 'display:none' }}">
        <div class="thread-head">
          <div class="av" style="width:38px;height:38px;font-size:17px;border-radius:50%;background:var(--line);display:flex;align-items:center;justify-content:center">{{ $b['emoji'] }}</div>
          <div><b>{{ $b['name'] }}</b><div style="font-size:12px;color:var(--ink-soft)">Pembeli</div></div>
        </div>
        <div class="thread-body">
          @forelse($b['msgs'] as $m)
            <div class="bubble {{ $m['me'] ? 'me' : 'them' }}">{{ $m['t'] }}</div>
          @empty
            <div class="empty"><div class="ic">💬</div>Belum ada percakapan dengan {{ $b['name'] }}</div>
          @endforelse
        </div>
        <div class="thread-input">
          <input placeholder="Tulis pesan...">
          <button type="button">➤</button>
        </div>
      </div>
    @empty
      <div class="empty"><div class="ic">💬</div>Belum ada pembeli yang menghubungi lapakmu</div>
    @endforelse
  </div>

</div>
@endsection

@push('scripts')
<script>TaniSegar.initChat('b');</script>
@endpush