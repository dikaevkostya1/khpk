<section id="request">
    <form method="post">
        @csrf
        <select name="specialties_id">
            @foreach ($specialties as $specialty)
                <option value="{{ $specialty->id }}" {{ $specialty->select }}>{{ $specialty->name }}</option>
            @endforeach
        </select>
        <input type="file" name="documents">
        <div class="message"></div>
    </form>
</section>
<script src="/js/request.js"></script>