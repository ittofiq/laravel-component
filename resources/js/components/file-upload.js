export default function fileUploadComponent(maxSize) {
    return {
        files: [], isDragging: false, maxSize,

        handleFileSelect(e) { this.addFiles(Array.from(e.target.files || [])); },
        handleDrop(e) { this.isDragging = false; this.addFiles(Array.from(e.dataTransfer.files || [])); },

        addFiles(fileList) {
            fileList.forEach(file => {
                if (file.size > this.maxSize) {
                    this.files.push({ name: file.name, size: file.size, type: file.type, status: 'error', error: `File terlalu besar (max ${this.formatFileSize(this.maxSize)})` });
                } else {
                    this.files.push({ name: file.name, size: file.size, type: file.type, progress: 0, status: null, error: null });
                    this.simulateUpload(this.files.length - 1);
                }
            });
        },

        removeFile(idx) { this.files.splice(idx, 1); },

        simulateUpload(idx) {
            const file = this.files[idx];
            let progress = 0;
            const interval = setInterval(() => {
                progress += Math.random() * 30;
                if (progress >= 100) { progress = 100; file.progress = 100; file.status = 'success'; clearInterval(interval); }
                else { file.progress = Math.round(progress); }
            }, 200);
        },

        formatFileSize(bytes) {
            if (bytes === 0) return '0 B';
            const k = 1024, sizes = ['B', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        },

        getFileIcon(type) {
            if (type.startsWith('image/')) return '🖼️';
            if (type.startsWith('video/')) return '🎥';
            if (type.startsWith('audio/')) return '🎵';
            if (type.includes('pdf')) return '📄';
            if (type.includes('word') || type.includes('document')) return '📝';
            if (type.includes('sheet') || type.includes('excel')) return '📊';
            return '📎';
        }
    };
}