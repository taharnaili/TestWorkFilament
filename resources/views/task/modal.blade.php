<!DOCTYPE html>
<html>
<head>
    <title>Edit Status</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body class="bg-dark text-white">



<div id="taskModal" class="container">
     @if(session('success'))
  <div class="alert alert-success p-3 fw-bold fs-5 mb-3">
    {{session('success')}}
  </div>
  @endif

    <a href="../" class="btn btn-info mb-2 mt-2">Retour</a>
    <form id="updateTaskForm" action="{{route('tasks.updateStatus',$task->id)}}" method="POST" class="mt-4">
        @csrf
        @method('PUT')

        <label for="status" class="fw-bold">Nouveau statut :</label>
         <select name="status" id="status" class="form-select">
        @foreach(['pending' => 'pending', 'in-progress' => 'in-progress', 'completed' => 'completed'] as $value => $label)
            <option value="{{ $value }}" {{ $task->status == $value ? 'selected' : '' }}>{{ $label }}</option>
        @endforeach
    </select>

        <button type="submit" class="btn btn-primary mt-3">Mettre à jour</button>
    </form>
</div>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
