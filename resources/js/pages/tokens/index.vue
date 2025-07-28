<script setup lang="ts">
import { Button } from '@/components/ui/button';
import StatusBadge from '@/components/ui/status-badge.vue';
import { Game } from '@/types/game';
import { Head, router } from '@inertiajs/vue3';
import axios from 'axios';
import { ref } from 'vue';
import { Dialog, DialogContent, DialogDescription, DialogHeader, DialogTitle } from '@/components/ui/dialog';
import { formatDateTime } from '@/lib/utils';

const props = defineProps<{
    token: string;
    success?: string | null;
}>();

const isGenerating = ref(false);
const isDeactivating = ref(false);
const isLucky = ref(false);

const generateToken = () => {
    isGenerating.value = true;
    router.post(
        route('tokens.generate', { oldToken: props.token }),
        {},
        {
            onSuccess: () => {
                isGenerating.value = false;
            },
        },
    );
};

const deactivateToken = () => {
    if (confirm('Are you sure you want to deactivate this token?')) {
        router.delete(route('tokens.tokens.deactivate', { token: props.token }), {
            onSuccess: () => {
                isDeactivating.value = false;
            },
        });
    }
};

const game = ref<Game | null>(null);

const feelingLucky = () => {
    isLucky.value = true;
    axios.post(route('games.play')).then(({ data }) => {
        game.value = data.data as Game;

        isLucky.value = false;
    });
};

const isHistory = ref(false);
const isHistoryLoading = ref(false);
const games = ref<Game[]>([]);

const openHistory = () => {
    isHistoryLoading.value = true;

    axios.get(route('games.index')).then(({ data }) => {
        isHistory.value = true;
        isHistoryLoading.value = false;
        games.value = data.data as Game[];
    });
};
</script>

<template>
    <Head title="Access Tokens" />

    <div class="container mx-auto p-4">
        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-2xl font-bold">Access Tokens</h1>
            <div class="flex gap-2">
                <Button @click="generateToken" :disabled="isGenerating">
                    {{ isGenerating ? 'Generating...' : 'Generate New Token' }}
                </Button>
                <Button @click="deactivateToken" :disabled="isDeactivating" variant="destructive">
                    {{ isDeactivating ? 'Deactivating...' : 'Deactivate' }}
                </Button>
            </div>
        </div>

        <div class="overflow-hidden rounded-lg bg-card shadow">
            <div v-if="success" class="p-4">
                <p class="text-sm text-green-500">
                    {{ success }}
                </p>
            </div>
        </div>

        <div class="mt-8 flex justify-center">
            <div class="flex gap-2">
                <Button @click="feelingLucky" :disabled="isLucky" variant="outline" class="px-8">
                    {{ isLucky ? 'Loading...' : 'Imfeelinglucky' }}
                </Button>
                <Button @click="openHistory" :disabled="isHistoryLoading" variant="outline" class="px-8">
                    {{ isHistoryLoading ? 'Loading...' : 'History' }}
                </Button>
            </div>
        </div>
        <div class="mt-8 flex justify-center">
            <StatusBadge v-if="game?.is_win" size="lg" status="success" :text="`Win ${game.winnings}`" />
            <StatusBadge v-if="game?.is_win === false" size="lg" status="error" text="Lose" />
        </div>
    </div>

    <Dialog :open="isHistory" @update:open="isHistory = $event">
        <DialogContent class="sm:max-w-md">
            <DialogHeader>
                <DialogTitle>Game Histories</DialogTitle>
                <DialogDescription>
                    Here is the history of the last 3 games
                </DialogDescription>
            </DialogHeader>

            <div class="flex flex-col gap-4 py-4">
                <div v-for="game in games" :key="game.id" class="flex flex-col gap-2">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-muted-foreground">
                            {{ formatDateTime(game.created_at) }}
                        </div>
                        <div class="text-sm text-muted-foreground">
                            <StatusBadge v-if="game.is_win" size="md" status="success" text="Win" />
                            <StatusBadge v-if="game.is_win === false" size="md" status="error" text="Lose" />
                        </div>
                    </div>
                    <div class="text-sm text-muted-foreground">
                        {{ game.winnings }}
                    </div>
                </div>
            </div>
        </DialogContent>
    </Dialog>
</template>
