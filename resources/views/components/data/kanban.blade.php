{{-- Komponen Kanban Board dengan Drag-Drop --}}
@props([
    'columns' => [],
])

@php
    $uniqueId = 'kanban-' . uniqid();
    $columnsJson = json_encode($columns);
@endphp

<div x-data="kanbanComponent('{{ $uniqueId }}', {{ $columnsJson }})" class="flex gap-4 overflow-x-auto pb-4">
    <template x-for="(column, colIndex) in columns" :key="colIndex">
        <div class="flex-1 min-w-72 flex flex-col bg-gray-100 dark:bg-gray-800 rounded-lg">
            <!-- Column Header -->
            <div class="p-4 bg-gray-200 dark:bg-gray-700 border-b border-gray-300 dark:border-gray-600">
                <h3 class="font-semibold text-gray-900 dark:text-white" x-text="column.title"></h3>
                <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">
                    <span x-text="column.items.length"></span> task
                </p>
            </div>

            <!-- Cards Drop Zone -->
            <div
                @dragover.prevent
                @drop="moveCard($event, colIndex)"
                class="flex-1 p-4 space-y-3 min-h-96"
                :style="dragOverColumn === colIndex ? 'background-color: rgba(59, 130, 246, 0.1)' : ''"
                @dragenter="dragOverColumn = colIndex"
                @dragleave="dragOverColumn = -1"
            >
                <template x-for="(card, cardIndex) in column.items" :key="cardIndex">
                    <div
                        draggable="true"
                        @dragstart="startDrag($event, colIndex, cardIndex)"
                        @dragend="dragOverColumn = -1"
                        class="p-3 bg-white dark:bg-gray-700 rounded-lg shadow hover:shadow-md cursor-move transition-shadow"
                    >
                        <p class="font-medium text-gray-900 dark:text-white text-sm" x-text="card.title"></p>
                        <p class="text-xs text-gray-600 dark:text-gray-400 mt-1" x-text="card.description"></p>
                        <div class="flex gap-2 mt-2">
                            <span class="inline-block px-2 py-0.5 bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300 text-xs rounded" x-text="card.priority"></span>
                            <span class="inline-block px-2 py-0.5 bg-purple-100 dark:bg-purple-900/30 text-purple-800 dark:text-purple-300 text-xs rounded" x-text="card.assignee"></span>
                        </div>
                    </div>
                </template>

                <div x-show="column.items.length === 0" class="text-center text-gray-400 dark:text-gray-500 py-8">
                    <p class="text-sm">Drag cards here</p>
                </div>
            </div>
        </div>
    </template>
</div>

<script>
function kanbanComponent(uniqueId, columns) {
    return {
        uniqueId,
        columns,
        dragOverColumn: -1,
        draggedCard: null,

        startDrag(event, colIndex, cardIndex) {
            this.draggedCard = { colIndex, cardIndex };
            event.dataTransfer.effectAllowed = 'move';
        },

        moveCard(event, toColIndex) {
            event.preventDefault();

            if (!this.draggedCard) return;

            const { colIndex: fromColIndex, cardIndex } = this.draggedCard;

            if (fromColIndex === toColIndex) {
                this.draggedCard = null;
                return;
            }

            const card = this.columns[fromColIndex].items[cardIndex];
            this.columns[fromColIndex].items.splice(cardIndex, 1);
            this.columns[toColIndex].items.push(card);

            this.draggedCard = null;
            this.dragOverColumn = -1;
        }
    };
}
</script>
