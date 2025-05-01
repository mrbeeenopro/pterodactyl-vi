import React from 'react';
import tw from 'twin.macro';
import Icon from '@/components/elements/Icon';
import { faExclamationTriangle } from '@fortawesome/free-solid-svg-icons';

interface State {
    hasError: boolean;
}

// eslint-disable-next-line @typescript-eslint/ban-types
class ErrorBoundary extends React.Component<{}, State> {
    state: State = {
        hasError: false,
    };

    // Phương thức này được gọi khi có lỗi xảy ra trong cây con của component
    static getDerivedStateFromError() {
        return { hasError: true };
    }

    // Phương thức này được sử dụng để ghi log lỗi
    componentDidCatch(error: Error) {
        console.error(error);
    }

    // Phương thức render hiển thị giao diện dựa trên trạng thái lỗi
    render() {
        return this.state.hasError ? (
            <div css={tw`flex items-center justify-center w-full my-4`}>
                <div css={tw`flex items-center bg-neutral-900 rounded p-3 text-red-500`}>
                    <Icon icon={faExclamationTriangle} css={tw`h-4 w-auto mr-2`} />
                    <p css={tw`text-sm text-neutral-100`}>
                        Đã xảy ra lỗi trong ứng dụng khi hiển thị giao diện này. Hãy thử làm mới trang.
                    </p>
                </div>
            </div>
        ) : (
            this.props.children
        );
    }
}

export default ErrorBoundary;
