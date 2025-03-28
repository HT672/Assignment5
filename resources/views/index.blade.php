
@extends('layout')
@section('title', 'Students')
@section('content')
<h2>Students</h2>
<!-- TODO: Add search bar here -->
<input type="text" id="search" placeholder="Search students">
<input type="number" id="minAge" placeholder="Min Age">
<input type="number" id="maxAge" placeholder="Max Age">
<table id="studentTable"></table>
<table class="table mt-3">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
        </tr>
    </thead>
    <tbody id="student-table">
        <!-- TODO: Display student list here -->
        @foreach ($students as $student)
        <tr>
            <td>{{ $student->name }}</td>
            <td>{{ $student->age }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<script>
<!-- TODO: Add jQuery AJAX logic -->
$('#search').on('keyup', function() {
    let query = $(this).val();
    $.ajax({
        url: '{{ route("students.search") }}',
        method: 'GET',
        data: { query: query },
        success: function(data) {
            $('#studentTable').html(data);
        }
    });
});

function fetchStudents() {
    let query = $('#search').val();
    let minAge = $('#minAge').val();
    let maxAge = $('#maxAge').val();
    
    $.ajax({
        url: '{{ route("students.filter") }}',
        method: 'GET',
        data: { query: query, minAge: minAge, maxAge: maxAge },
        success: function(data) {
            $('#studentTable').html(data);
        }
    });
}

$('#search, #minAge, #maxAge').on('keyup change', fetchStudents);

</script>
@endsection