
<template>
   <div v-if="editor">
    <button @click.prevent="editor.chain().focus().toggleBold().run()" :disabled="!editor.can().chain().focus().toggleBold().run()" class="badge text-bg-secondary mr-1" :class="{ 'is-active': editor.isActive('bold') }">
      bold
    </button>
    <button @click.prevent="editor.chain().focus().toggleItalic().run()" :disabled="!editor.can().chain().focus().toggleItalic().run()" class="badge text-bg-secondary mr-1" :class="{ 'is-active': editor.isActive('italic') }">
      italic
    </button>
    <button @click.prevent="editor.chain().focus().toggleStrike().run()" :disabled="!editor.can().chain().focus().toggleStrike().run()" class="badge text-bg-secondary mr-1" :class="{ 'is-active': editor.isActive('strike') }">
      strike
    </button>
    <button @click.prevent="editor.chain().focus().toggleCode().run()" :disabled="!editor.can().chain().focus().toggleCode().run()" class="badge text-bg-secondary mr-1" :class="{ 'is-active': editor.isActive('code') }">
      code
    </button>
    <button @click.prevent="editor.chain().focus().unsetAllMarks().run()" class="badge text-bg-secondary mr-1">
      clear marks
    </button>
    <button @click.prevent="editor.chain().focus().clearNodes().run()" class="badge text-bg-secondary mr-1">
      clear nodes
    </button>
    <button @click.prevent="editor.chain().focus().setParagraph().run()" class="badge text-bg-secondary mr-1" :class="{ 'is-active': editor.isActive('paragraph') }">
      paragraph
    </button>
    <button @click.prevent="editor.chain().focus().toggleHeading({ level: 1 }).run()" class="badge text-bg-secondary mr-1" :class="{ 'is-active': editor.isActive('heading', { level: 1 }) }">
      h1
    </button>
    <button @click.prevent="editor.chain().focus().toggleHeading({ level: 2 }).run()" class="badge text-bg-secondary mr-1" :class="{ 'is-active': editor.isActive('heading', { level: 2 }) }">
      h2
    </button>
    <button @click.prevent="editor.chain().focus().toggleHeading({ level: 3 }).run()" class="badge text-bg-secondary mr-1" :class="{ 'is-active': editor.isActive('heading', { level: 3 }) }">
      h3
    </button>
    <button @click.prevent="editor.chain().focus().toggleHeading({ level: 4 }).run()" class="badge text-bg-secondary mr-1" :class="{ 'is-active': editor.isActive('heading', { level: 4 }) }">
      h4
    </button>
    <button @click.prevent="editor.chain().focus().toggleHeading({ level: 5 }).run()" class="badge text-bg-secondary mr-1" :class="{ 'is-active': editor.isActive('heading', { level: 5 }) }">
      h5
    </button>
    <button @click.prevent="editor.chain().focus().toggleHeading({ level: 6 }).run()" class="badge text-bg-secondary mr-1" :class="{ 'is-active': editor.isActive('heading', { level: 6 }) }">
      h6
    </button>
    <br>
    <button @click.prevent="editor.chain().focus().toggleBulletList().run()" class="badge text-bg-secondary mr-1" :class="{ 'is-active': editor.isActive('bulletList') }">
      bullet list
    </button>
    <button @click.prevent="editor.chain().focus().toggleOrderedList().run()" class="badge text-bg-secondary mr-1" :class="{ 'is-active': editor.isActive('orderedList') }">
      ordered list
    </button>
    <button @click.prevent="editor.chain().focus().toggleCodeBlock().run()"  class="badge text-bg-secondary mr-1" :class="{ 'is-active': editor.isActive('codeBlock') }">
      code block
    </button>
    <button @click.prevent="editor.chain().focus().toggleBlockquote().run()" class="badge text-bg-secondary mr-1" :class="{ 'is-active': editor.isActive('blockquote') }">
      blockquote
    </button>
    <button @click.prevent="editor.chain().focus().setHorizontalRule().run()" class="badge text-bg-secondary mr-1">
      horizontal rule
    </button>
    <button @click.prevent="editor.chain().focus().setHardBreak().run()" class="badge text-bg-secondary mr-1">
      hard break
    </button>
    <button @click.prevent="editor.chain().focus().undo().run()" class="badge text-bg-secondary mr-1" :disabled="!editor.can().chain().focus().undo().run()">
      undo
    </button>
    <button @click.prevent.prevent="editor.chain().focus().redo().run()" class="badge text-bg-secondary mr-1" :disabled="!editor.can().chain().focus().redo().run()">
      redo
    </button>
  </div>
  <editor-content :editor="editor"/>
</template>

<script>
import StarterKit from '@tiptap/starter-kit'
import { Editor, EditorContent } from '@tiptap/vue-3'

export default {
  components: {
    EditorContent,
  },

  props: {
    modelValue: {
      type: String,
      default: '',
    },
  },

  emits: ['update:modelValue'],

  data() {
    return {
      editor: null,
    }
  },

  watch: {
    modelValue(value) {
      // HTML
      const isSame = this.editor.getHTML() === value

      // JSON
      // const isSame = JSON.stringify(this.editor.getJSON()) === JSON.stringify(value)

      if (isSame) {
        return
      }

      this.editor.commands.setContent(value, false)
    },
  },

  mounted() {
    this.editor = new Editor({
      extensions: [
        StarterKit,
      ],
      content: this.modelValue,
      attributes: {

    },
      onUpdate: () => {
        // HTML
        this.$emit('update:modelValue', this.editor.getHTML())

        // JSON
        // this.$emit('update:modelValue', this.editor.getJSON())
      },
    })
  },

  beforeUnmount() {
    this.editor.destroy()
  },
}
</script>


<style lang="scss">
/* Basic editor styles */
.ProseMirror {
  > * + * {
    margin-top: 0.75em;
  }

  ul,
  ol {
    padding: 0 1rem;
  }

  h1,
  h2,
  h3,
  h4,
  h5,
  h6 {
    line-height: 1.1;
  }

  code {
    background-color: rgba(#616161, 0.1);
    color: #616161;
  }

  pre {
    background: #0D0D0D;
    color: #FFF;
    font-family: 'JetBrainsMono', monospace;
    padding: 0.75rem 1rem;
    border-radius: 0.5rem;

    code {
      color: inherit;
      padding: 0;
      background: none;
      font-size: 0.8rem;
    }
  }

  img {
    max-width: 100%;
    height: auto;
  }

  blockquote {
    padding-left: 1rem;
    border-left: 2px solid rgba(#0D0D0D, 0.1);
  }

  hr {
    border: none;
    border-top: 2px solid rgba(#0D0D0D, 0.1);
    margin: 2rem 0;
  }
}
</style>