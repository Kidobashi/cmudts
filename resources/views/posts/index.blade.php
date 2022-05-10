<?
dd
?>
<form method="POST" action="/auth.register/">
<div class="row mb-3">
    <x-label for="officeName" :value="__('Assigned Office')" />
        <select id ="assignedOffice" name="assignedOffice" class="form-controll">
            <option value="old(assignedOffice)" selected disabled>Select Office
                @foreach ($officeName as $row)
                <option value="{{ $row->id }}">{{ $row->officeName }}</option>
            </option>
            @endforeach
        </select>
</div>
</form>