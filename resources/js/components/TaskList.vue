<template>
  <ul class="space-y-4">
    <li
      v-for="task in tasks"
      :key="task.task_id"
      class="relative bg-white px-5 py-3 rounded-xl shadow-sm border hover:shadow-md transition"
    >
      <div class="flex justify-between items-start">
        <!-- Task Content -->
        <div class="flex-1">
          <!-- If editing -->
          <div v-if="editingId === task.task_id" class="flex gap-2">
            <input
              v-model="editContent"
              type="text"
              class="flex-1 px-3 py-2 border rounded-lg focus:ring focus:ring-blue-300 text-sm"
            />
            <button
              @click="updateTask(task.task_id)"
              class="px-3 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 text-sm"
            >
              Save
            </button>
            <button
              @click="cancelEdit"
              class="px-3 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 text-sm"
            >
              Cancel
            </button>
          </div>

          <!-- If not editing -->
          <div v-else>
            <div class="text-gray-800 font-medium">{{ task.content }}</div>
            <div class="text-xs text-gray-400 mt-1">
              {{ formatDate(task.created_at) }}
            </div>
          </div>
        </div>

        <!-- Ellipsis Menu -->
        <div class="relative ml-4" v-if="editingId !== task.task_id">
          <button
            @click.stop="toggleMenu(task.task_id)"
            class="p-2 rounded-full hover:bg-gray-100 focus:outline-none"
          >
            <svg
              class="w-5 h-5 text-gray-600"
              viewBox="0 0 24 24"
              fill="currentColor"
            >
              <path
                d="M12 7a2 2 0 110-4 2 2 0 010 4zm0 7a2 2 0 110-4 2 2 0 010 4zm0 7a2 2 0 110-4 2 2 0 010 4z"
              />
            </svg>
          </button>

          <!-- Dropdown -->
          <transition name="fade">
            <div
              v-if="openMenu === task.task_id"
              class="absolute right-0 mt-2 w-36 bg-white border rounded-lg shadow-lg z-50"
            >
              <button
                @click.stop="startEdit(task)"
                class="block w-full text-left px-4 py-2 text-sm hover:bg-gray-50"
              >
                Edit
              </button>
              <button
                @click.stop="remove(task.task_id)"
                class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50"
              >
                Delete
              </button>
            </div>
          </transition>
        </div>
      </div>
    </li>
  </ul>
</template>

<script>
import axios from "axios";

export default {
  props: ["tasks"],
  data() {
    return {
      openMenu: null,
      editingId: null,
      editContent: "",
    };
  },
  methods: {
    toggleMenu(id) {
      this.openMenu = this.openMenu === id ? null : id;
    },
    startEdit(task) {
      this.editingId = task.task_id;
      this.editContent = task.content;
      this.openMenu = null;
    },
    cancelEdit() {
      this.editingId = null;
      this.editContent = "";
    },
    async updateTask(id) {
      if (!this.editContent.trim()) return;
      try {
        await axios.post(`/api/tasks/${id}`, {
          content: this.editContent,
          _method: "PUT", // tells Laravel to treat it as PUT
        });
        this.$emit("updated");
      } catch (err) {
        console.error("Update failed:", err);
        alert("Failed to update task.");
      } finally {
        this.cancelEdit();
      }
    },

    async remove(id) {
      try {
        await axios.delete(`/api/tasks/${id}`);
        this.$emit("deleted");
      } catch (err) {
        console.error("Delete failed:", err);
        alert("Failed to delete task.");
      } finally {
        this.openMenu = null;
      }
    },
    formatDate(iso) {
      if (!iso) return "";
      return new Date(iso).toLocaleString();
    },
    handleOutsideClick(e) {
      if (!this.$el.contains(e.target)) {
        this.openMenu = null;
      }
    },
  },
  mounted() {
    document.addEventListener("click", this.handleOutsideClick);
  },
  beforeUnmount() {
    document.removeEventListener("click", this.handleOutsideClick);
  },
};
</script>

<style>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.15s ease;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>
