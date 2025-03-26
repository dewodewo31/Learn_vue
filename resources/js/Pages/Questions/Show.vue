<script setup>
import Answers from '../../Components/Answer/Answers.vue';
import CreateAnswer from '../../Components/Answer/CreateAnswer.vue';
import Author from '../../Components/Author.vue';
import AppLayouts from '../../Layouts/AppLayout.vue';
import { Head, router } from "@inertiajs/vue3"
import Votable from '../../Components/Votable.vue';
import UseVote from '../../Composable/UseVote';

const props = defineProps({
  question: {
    type: Object,
    required: true,
  },
  answers: {
    type: Object,
    required: true
  }
})

const bookmark = () => {
  if (props.question.is_bookmarked) {
    router.delete(route('questions.bookmark.destroy', props.question.id), {
      preserveScroll: true
    })
  } else {
    router.post(route('questions.bookmark.store', props.question.id), {}, {
      preserveScroll: true
    })
  }
}

const { upVote, downVote } = UseVote(props.question, 'questions.vote')

</script>

<template>

  <Head :title="question.title" />
  <AppLayouts>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="border-bottom pb-3 mb-4">
            <div class="d-flex align-items-center justify-content-between">
              <h1 class="question-title">{{ question.title }} </h1>
              <a href="index.html" class="btn btn-outline-secondary">All Questions</a>
            </div>
            <div class="d-flex question-meta">
              <div class="me-3">
                <span class="text-muted">Asked</span> <time :datetime="question.created_at.machine">{{
                  question.created_at.human }}</time>
              </div>
              <div class="me-3">
                <span class="text-muted">Modified</span> {{ question.updated_at.human }}
              </div>
              <div>
                <span class="text-muted">Viewed</span> {{ question.views_count }} times
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-9">
          <Votable class="question-content" @up-vote="upVote" @down-vote="downVote" :votes="question.votes_count">
            <!-- Default slot content -->
            <div class="post-col actionable">
              <div class="question-body" v-html="question.body"></div>
              <div class="d-flex justify-content-between align-items-start py-3">
                <ul class="tags-inline">
                  <li><a href="#" class="tag">PHP</a></li>
                  <li><a href="#" class="tag">Laravel</a></li>
                  <li><a href="#" class="tag">OOP</a></li>
                </ul>
                <Author :post-at="question.created_at" :user="question.user" />
              </div>
            </div>

            <!-- Extra slot HARUS di luar default slot content -->
            <template #extra>
              <button title="Bookmark the post" class="btn text-secondary" @click="bookmark"
                :class="{ 'question-bookmarked': question.is_bookmarked }">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                  class="bi bi-bookmark-fill" viewBox="0 0 16 16">
                  <path
                    d="M2 2v13.5a.5.5 0 0 0 .74.439L8 13.069l5.26 2.87A.5.5 0 0 0 14 15.5V2a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2" />
                </svg>
              </button>
            </template>
          </Votable>


          <Answers :answers="answers" />


          <CreateAnswer :question="question" />
        </div>
        <div class="col-md-3">
          <h3 class="fs-5 mb-3">Related</h3>
          <div class="related">
            <div class="related-item">
              <a href="#">
                <div class="answer-votes">5</div>
              </a>
              <a href="#">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Molestias, dignissimos!</a>
            </div>
            <div class="related-item">
              <a href="#">
                <div class="answer-votes">3</div>
              </a>
              <a href="#">Lorem ipsum dolor sit amet consectetur adipisicing.</a>
            </div>
            <div class="related-item">
              <a href="#">
                <div class="answer-votes answer-accepted">9</div>
              </a>
              <a href="#">Lorem ipsum dolor sit amet.</a>
            </div>
            <div class="related-item">
              <a href="#">
                <div class="answer-votes">7</div>
              </a>
              <a href="#">Lorem ipsum dolor sit amet.</a>
            </div>
          </div>

          <h3 class="fs-5 mt-5">Tags</h3>
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
  </AppLayouts>
</template>

<style scoped>
.question-bookmarked {
  color: #ff6b6b !important;
  fill: currentColor;
}
</style>