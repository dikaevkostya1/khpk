@foreach ($specialties as $specialty)
    {{ $specialty->code }}
    {{ $specialty->name }}
@endforeach