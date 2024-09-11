<template>
    <div>
        <h1>Upload File</h1>
        <form @submit.prevent="uploadFile">
            <div
                class="drop-area"
                @drop.prevent="handleDrop"
                @dragover.prevent="handleDragOver"
                @dragleave="handleDragLeave"
                :class="{ 'dragging': isDragging }"
                @click="triggerFileInput"
            >
                <input
                    type="file"
                    ref="fileInput"
                    @change="handleFileInput"
                    hidden
                />
                <p v-if="file">Selected file: {{ file.name }}</p>
                <p v-else>Drag and drop a file here or click to select</p>
            </div>
            <input v-model="name" type="text" placeholder="File name (optional)">
            <button type="submit">Upload</button>
        </form>

        <div v-if="progress !== null">
            <p>Progress: {{ progress }}%</p>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';

const file = ref(null);
const name = ref('');
const progress = ref(null);
const isDragging = ref(false);
const fileInput = ref(null);

const handleFileInput = (e) => {
    file.value = e.target.files[0];
};

const handleDrop = (e) => {
    file.value = e.dataTransfer.files[0];
    isDragging.value = false;
};

const handleDragOver = () => {
    isDragging.value = true;
};

const handleDragLeave = () => {
    isDragging.value = false;
};

const triggerFileInput = () => {
    fileInput.value.click();
};

const uploadFile = async () => {
    if (!file.value) {
        alert('Please select a file.');
        return;
    }

    const formData = new FormData();
    formData.append('file', file.value);
    formData.append('name', name.value);

    try {
        const response = await axios.post('/files', formData, {
            headers: {
                'Content-Type': 'multipart/form-data',
            },
            onUploadProgress: (progressEvent) => {
                progress.value = Math.round((progressEvent.loaded * 100) / progressEvent.total);
            },
        });

        alert('File uploaded successfully');
        progress.value = null;
        file.value = null;
        name.value = '';
    } catch (error) {
        console.error('Error uploading file:', error);
        alert('Failed to upload file');
    }
};
</script>

<style>
.drop-area {
    border: 2px dashed #ccc;
    padding: 20px;
    text-align: center;
    cursor: pointer;
}
.dragging {
    border-color: #007bff;
    background-color: #e9f7fe;
}
</style>
