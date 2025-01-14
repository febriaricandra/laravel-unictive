<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="overflow-hidden overflow-x-auto border-b border-gray-200 bg-white p-6">
                    <form action="{{ route('users.update', $user) }}" method="POST" id="userForm">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="name" value="Name" />
                            <x-text-input id="name" name="name" value="{{ old('name', $user->name) }}" type="text" class="block mt-1 w-full" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="hobbies" value="Hobbies" />
                            <div id="hobbies">
                                @foreach ($user->hobbies as $index => $hobby)
                                    <div class="hobby-input">
                                        <x-text-input name="hobbies[{{ $index }}][name]" value="{{ old('hobbies.' . $index . '.name', $hobby->name) }}" type="text" class="block mt-1 w-full" />
                                        <x-input-error :messages="$errors->get('hobbies.' . $index . '.name')" class="mt-2" />
                                        <button type="button" class="remove-hobby mt-2 text-red-500">Remove</button>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" id="addHobby" class="mt-2 text-blue-500">Add Hobby</button>
                        </div>

                        <div class="mt-4">
                            <x-primary-button id="saveButton">
                                Save
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let hobbyIndex = {{ $user->hobbies->count() }};

            function updateSaveButtonState() {
                const hobbyInputs = document.querySelectorAll('.hobby-input');
                const saveButton = document.getElementById('saveButton');
                saveButton.disabled = hobbyInputs.length === 0;
            }

            document.getElementById('addHobby').addEventListener('click', function() {
                const hobbiesDiv = document.getElementById('hobbies');
                const newHobbyDiv = document.createElement('div');
                newHobbyDiv.classList.add('hobby-input');
                newHobbyDiv.innerHTML = `
                    <x-text-input name="hobbies[${hobbyIndex}][name]" type="text" class="block mt-1 w-full" />
                    <x-input-error :messages="$errors->get('hobbies.${hobbyIndex}.name')" class="mt-2" />
                    <button type="button" class="remove-hobby mt-2 text-red-500">Remove</button>
                `;
                hobbiesDiv.appendChild(newHobbyDiv);
                hobbyIndex++;
                updateSaveButtonState();
            });

            document.getElementById('hobbies').addEventListener('click', function(event) {
                if (event.target.classList.contains('remove-hobby')) {
                    event.target.parentElement.remove();
                    updateSaveButtonState();
                }
            });

            document.getElementById('userForm').addEventListener('submit', function(event) {
                const hobbyInputs = document.querySelectorAll('.hobby-input input');
                for (let input of hobbyInputs) {
                    if (input.value.trim() === '') {
                        event.preventDefault();
                        alert('Hobby cannot be empty');
                        return;
                    }
                }
            });

            updateSaveButtonState();
        });
    </script>
</x-app-layout>