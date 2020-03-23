<template>
    <div class="inline bg-green-400 p-2 rounded">
        {{ body }}
    </div>
</template>

<script>
    export default {
        data() {
            return {
                body: 'I am a vue component!'
            }
        }
    }
</script>