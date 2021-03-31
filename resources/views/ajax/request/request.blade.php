<section id="request">
    <form method="post" enctype="multipart/form-data">
        @csrf
        <select name="speciality_id">
            @foreach ($specialties as $specialty)
                <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
            @endforeach
        </select>
        <input type="file" name="documents">
        <input type="submit" value="Отправить">
    </form>
    <div class="message"></div>
</section>
<script src="{{ mix('/js/request.js') }}"></script>