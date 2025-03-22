<template>
    <Applayout>
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="d-flex align-items-center justify-content-between">
                        <h1 class="page-header">All Questions</h1>
                    </div>
                    <div class="card mt-3">
                        <ul class="list-group list-group-flush">
                            <QuestionSummary v-for="question in questions.data" :key="question.id" :question="question"
                                @edit="editQuestion" @remove="removeQuestion" />
                        </ul>
                    </div>

                    <Pagination :meta="questions.meta" />
                </div>
                <div class="col-md-3">
                    <div class="d-grid">
                        <button class="btn btn-primary" data-bs-toggle="modal" @click="askQuestion">Ask
                            Question</button>
                    </div>

                    <QuestionFilter :filter="filter" />
                    <h2 class="fs-5 mt-5">Related Tags</h2>
                    <ul class="tags-list mt-3">
                        <li><a href="#" class="tag mb-2">Javascript</a></li>
                        <li><a href="#" class="tag mb-2">JQuery</a></li>
                        <li><a href="#" class="tag mb-2">Vue.js</a></li>
                        <li><a href="#" class="tag mb-2">React.js</a></li>
                        <li><a href="#" class="tag mb-2">Inertia.js</a></li>
                        <li><a href="#" class="tag mb-2">PHP</a></li>
                        <li><a href="#" class="tag mb-2">Laravel</a></li>
                        <li><a href="#" class="tag mb-2">Bootstrap</a></li>
                        <li><a href="#" class="tag mb-2">Tailwind</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <Modal id="question-modal" :title="modalTitle" size="large" scrollable @hidden="editing = false">

            <component :is="editing ? EditQuestionForm : CreateQuestionForm" :question="question"
                @success="hideModal" />
        </Modal>
    </Applayout>
    <!-- <h1>Welcome!</h1>
  <div v-for="question in questions" :key="question.id">
    <Link :href="`/questions/${question.id}`">
    {{ question.title }}
  </Link>
    </div> -->

    <Head title="All Questions" />
</template>

<script setup>
import { reactive, ref } from 'vue';
import { Head, router } from "@inertiajs/vue3";
import Applayout from "../../Layouts/AppLayout.vue";
import QuestionSummary from "../../Components/Question/QuestionSummary.vue";
import Pagination from "../../Components/Pagination.vue";
import UseModal from '../../Composable/UseModal';
import CreateQuestionForm from '../../Components/Question/CreateQuestionForm.vue';
import EditQuestionForm from '../../Components/Question/EditQuestionForm.vue';
import QuestionFilter from '../../Components/Question/QuestionFilter.vue';

const { showModal, hideModal, modalTitle, Modal } = UseModal("#question-modal");

defineProps({
    questions: {
        type: Object,
        required: true
    },
    filter: String
})


const question = reactive({
    id: null,
    title: null,
    body: null
})

const editing = ref(false)


const editQuestion = (payload) => {
    editing.value = true
    modalTitle.value = "Edit Question"

    question.id = payload.id
    question.title = payload.title
    question.body = payload.body
    showModal()

}

const askQuestion = () => {
    editing.value = false
    modalTitle.value = "Ask Question"
    showModal()
}

const removeQuestion = (payload) => {
    if (confirm("Are You Sure?")) {
        router.delete(route('questions.destroy', payload.id), {
            preserveScroll: true
        })
    }
}
</script>